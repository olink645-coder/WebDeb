<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Recruitment Platform</title>
    <link rel="stylesheet" href="../backend/css/style.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <p>Welcome back! Please enter your details.</p>

        <?php if(isset($_GET['error'])): ?>
            <p style="color: red;">Invalid email or password.</p>
        <?php endif; ?>

        <form action="../backend/actions/login_action.php" method="POST">
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" required placeholder="Enter your email">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required placeholder="Enter your password">
            </div>

            <button type="submit" class="btn-primary">Login</button>
        </form>
        
        <p>Don't have an account? <a href="signup.php">Sign up here</a></p>
    </div>
</body>
</html>