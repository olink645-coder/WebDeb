<?php
session_start();
require_once '../includes/db.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Input validation
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    // 1. Verify email and password via the database
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Create session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['role'] = $user['role'];

        // 2. Redirect to Dashboard based on user role
        if ($user['role'] === 'recruiter') {
            header("Location: ../../recruiter/recruiter-dashboard.php");
        } else {
            header("Location: ../../candidate/candidate-dashboard.php");
        }
        exit();
    } else {
        // Redirect back to login with error message
        header("Location: ../../authentication/login.php?error=1");
        exit();
    }
}