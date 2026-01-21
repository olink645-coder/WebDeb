<?php
session_start();
require_once '../includes/db.php';

// Security Check: Ensure user is logged in and is a candidate
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'candidate') {
    header("Location: ../../authentication/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $job_id = $_POST['job_id'];
    $candidate_id = $_SESSION['user_id'];
    $status = 'Pending'; // Default status for new applications

    try {
        // 1. Check if the candidate has already applied to this job to prevent duplicates
        $check = $pdo->prepare("SELECT id FROM applications WHERE job_id = ? AND candidate_id = ?");
        $check->execute([$job_id, $candidate_id]);

        if ($check->rowCount() > 0) {
            // Already applied
            header("Location: ../../public/job-details.php?id=$job_id&error=already_applied");
            exit();
        }

        // 2. Insert application record
        $sql = "INSERT INTO applications (job_id, candidate_id, status, applied_at) VALUES (?, ?, ?, NOW())";
        $stmt = $pdo->prepare($sql);
        
        if ($stmt->execute([$job_id, $candidate_id, $status])) {
            header("Location: ../../candidate/candidate-dashboard.php?apply=success");
        } else {
            echo "Error submitting application.";
        }
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
}
?>