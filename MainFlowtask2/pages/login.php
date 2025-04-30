<?php include '../includes/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger">
                <?php 
                    switch($_GET['error']) {
                        case 'emptyfields':
                            echo "Please fill in all fields";
                            break;
                        case 'nouser':
                            echo "User does not exist";
                            break;
                        case 'wrongpassword':
                            echo "Incorrect username/email or password";
                            break;
                        default:
                            echo "An error occurred";
                    }
                ?>
            </div>
        <?php endif; ?>
        
        <?php if (isset($_GET['signup']) && $_GET['signup'] == 'success'): ?>
            <div class="alert alert-success">
                Registration successful! Please login.
            </div>
        <?php endif; ?>
        
        <form action="../includes/auth.php" method="POST">
            <input type="hidden" name="action" value="login">
            
            <div class="form-group">
                <label for="username_email">Username or Email</label>
                <input type="text" class="form-control" id="username_email" name="username_email" placeholder="Enter username or email">
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
            </div>
            
            <button type="submit" class="btn" name="login-submit">Login</button>
        </form>
        
        <div class="text-center mt-3">
            <p>Don't have an account? <a href="signup.php" class="link">Sign up</a></p>
        </div>
    </div>
</body>
</html>