<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up - Recruitment Platform</title>
    <link rel="stylesheet" href="../backend/css/style.css">
</head>
<body>
    <div class="signup-container">
        <h2>Create an Account</h2>
        
        <?php if(isset($_GET['error']) && $_GET['error'] == 'email_exists'): ?>
            <p style="color: red;">This email is already registered.</p>
        <?php endif; ?>

        <form action="../backend/actions/signup_action.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Full Name" required>
            
            <input type="email" name="email" placeholder="Email Address" required>
            
            <input type="password" name="password" placeholder="Password" required>
            
            <label>Register as:</label>
            <select name="role" required>
                <option value="candidate">Candidate</option>
                <option value="recruiter">Recruiter</option>
            </select>
            
            <label>Profile Photo (Optional):</label>
            <input type="file" name="profile_photo" accept="image/*">
            
            <button type="submit">Sign Up</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>