<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';

redirectIfNotLoggedIn();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <p>You are now logged in with email: <?php echo htmlspecialchars($_SESSION['email']); ?></p>
        
        <div class="text-center mt-3">
            <a href="../logout.php" class="btn">Logout</a>
        </div>
    </div>
</body>
</html>