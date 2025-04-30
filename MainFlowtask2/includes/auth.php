<?php
require_once 'config.php';
require_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    if ($action === 'signup') {
        handleSignup($pdo);
    } elseif ($action === 'login') {
        handleLogin($pdo);
    }
}

function handleSignup($pdo) {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    
    // Validate inputs
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        header("Location: ../pages/signup.php?error=emptyfields");
        exit();
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../pages/signup.php?error=invalidemail");
        exit();
    }
    
    if ($password !== $confirm_password) {
        header("Location: ../pages/signup.php?error=passwordmatch");
        exit();
    }
    
    // Check if user already exists
    $sql = "SELECT id FROM users WHERE username = :username OR email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['username' => $username, 'email' => $email]);
    
    if ($stmt->rowCount() > 0) {
        header("Location: ../pages/signup.php?error=usertaken");
        exit();
    }
    
    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Insert new user
    $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
    $stmt = $pdo->prepare($sql);
    
    try {
        $stmt->execute([
            'username' => $username,
            'email' => $email,
            'password' => $hashed_password
        ]);
        
        header("Location: ../pages/login.php?signup=success");
        exit();
    } catch (PDOException $e) {
        header("Location: ../pages/signup.php?error=sqlerror");
        exit();
    }
}

function handleLogin($pdo) {
    $username_email = trim($_POST['username_email'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($username_email) || empty($password)) {
        header("Location: ../pages/login.php?error=emptyfields");
        exit();
    }
    
    // Find user by username or email
    $sql = "SELECT * FROM users WHERE username = :username_email OR email = :username_email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['username_email' => $username_email]);
    
    if ($stmt->rowCount() === 0) {
        header("Location: ../pages/login.php?error=nouser");
        exit();
    }
    
    $user = $stmt->fetch();
    
    if (!password_verify($password, $user['password'])) {
        header("Location: ../pages/login.php?error=wrongpassword");
        exit();
    }
    
    // Login successful - create session
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['email'] = $user['email'];
    
    header("Location: ../pages/dashboard.php");
    exit();
}
?>