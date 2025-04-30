<?php include '../includes/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Sign Up</h1>
        
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger">
                <?php 
                    switch($_GET['error']) {
                        case 'emptyfields':
                            echo "All fields are required";
                            break;
                        case 'invalidemail':
                            echo "Invalid email format";
                            break;
                        case 'passwordmatch':
                            echo "Passwords do not match";
                            break;
                        case 'usertaken':
                            echo "Username or Email already exists";
                            break;
                        case 'sqlerror':
                            echo "Database error";
                            break;
                        default:
                            echo "An error occurred";
                    }
                ?>
            </div>
        <?php endif; ?>
        
        <form action="../includes/auth.php" method="POST">
            <input type="hidden" name="action" value="signup">
            
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
            </div>
            
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm password">
            </div>
            
            <button type="submit" class="btn" name="signup-submit">Sign Up</button>
        </form>
        
        <div class="text-center mt-3">
            <p>Already have an account? <a href="login.php" class="link">Login</a></p>
        </div>
    </div>
</body>
</html>