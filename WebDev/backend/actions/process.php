<?php
session_start();
require_once '../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    
    // Sanitize basic profile data
    $specialty = htmlspecialchars($_POST['specialty']);
    $bio = htmlspecialchars($_POST['bio']);
    
    // New Feature: CV Filtering Data
    $skills_tags = htmlspecialchars($_POST['skills_tags']); 
    $experience_years = (int)$_POST['experience_years'];
    $experience_level = $_POST['experience_level'];

    // Update the users table
    $sql = "UPDATE users SET 
            specialty = ?, 
            bio = ?, 
            skills_tags = ?, 
            experience_years = ?, 
            experience_level = ? 
            WHERE id = ?";
            
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute([$specialty, $bio, $skills_tags, $experience_years, $experience_level, $user_id])) {
        header("Location: ../../candidate/edit-profile.php?update=success");
    } else {
        echo "Error updating profile.";
    }
}
?>