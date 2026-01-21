<?php
session_start();
require_once '../includes/db.php';

// Check if user is a recruiter
if ($_SESSION['role'] !== 'recruiter') {
    header("Location: ../../authentication/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Sanitize Inputs
    $title = htmlspecialchars($_POST['title']);
    $location = htmlspecialchars($_POST['location']);
    $contract_type = $_POST['contract_type']; // Internship, Full-time, Part-time
    $description = htmlspecialchars($_POST['description']);
    $recruiter_id = $_SESSION['user_id'];
    
    // Filtering Criteria
    $required_skills = htmlspecialchars($_POST['required_skills']);
    $required_level = $_POST['required_level'];

    // 2. Secure Insert
    $sql = "INSERT INTO jobs (title, location, contract_type, description, recruiter_id, required_skills, required_level) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute([$title, $location, $contract_type, $description, $recruiter_id, $required_skills, $required_level])) {
        header("Location: ../../recruiter/recruiter-dashboard.php?post=success");
    } else {
        echo "Error publishing job.";
    }
}
?>