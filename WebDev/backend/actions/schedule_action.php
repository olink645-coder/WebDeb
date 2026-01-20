<?php
session_start();
require_once '../includes/db.php';

if ($_SESSION['role'] !== 'recruiter') { exit(); }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Collect Data
    $candidate_id = $_POST['candidate_id'];
    $offer_id = $_POST['offer_id']; // Passed from the hidden input
    $recruiter_id = $_SESSION['user_id'];
    $interview_date = $_POST['interview_date']; // DATETIME format
    $link = filter_var($_POST['link'], FILTER_SANITIZE_URL); // Google Meet/Zoom link
    $status = 'Upcoming';

    // 2. Insert into interviews table
    $sql = "INSERT INTO interviews (candidate_id, offer_id, recruiter_id, interview_date, link, status) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$candidate_id, $offer_id, $recruiter_id, $interview_date, $link, $status])) {
        // Optional: Trigger "Automatic notification to candidate" here
        header("Location: ../../recruiter/manage-applications.php?job_id=$offer_id&scheduled=true");
    } else {
        echo "Error scheduling interview.";
    }
}
?>