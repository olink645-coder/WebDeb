<?php
require_once '../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Input Validation
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Secure hashing
    $role = $_POST['role'];
    $photo_path = null;

    // 2. Check for unique email
    $checkEmail = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $checkEmail->execute([$email]);
    
    if ($checkEmail->rowCount() > 0) {
        header("Location: ../../authentication/signup.php?error=email_exists");
        exit();
    }

    // 3. Handle optional profile photo upload
    if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] == 0) {
        $upload_dir = '../../uploads/';
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);
        
        $file_name = time() . '_' . $_FILES['profile_photo']['name'];
        if (move_uploaded_file($_FILES['profile_photo']['tmp_name'], $upload_dir . $file_name)) {
            $photo_path = $file_name;
        }
    }

    // 4. Secure Insert using Prepared Statements
    $sql = "INSERT INTO users (name, email, password, role, profile_photo) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute([$name, $email, $password, $role, $photo_path])) {
        // Redirect to login after successful signup
        header("Location: ../../authentication/login.php?signup=success");
    } else {
        echo "Error: Could not register user.";
    }
}
?>