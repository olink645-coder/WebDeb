<?php 
require_once '../backend/includes/header.php';
require_once '../backend/includes/db.php';

if ($_SESSION['role'] !== 'recruiter') { header("Location: ../authentication/login.php"); exit(); }

// Fetch company profile info
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$company = $stmt->fetch();
?>

<div class="container">
    <h1>Recruiter Dashboard</h1>
    <div class="company-profile">
        <h3><?php echo $company['name']; ?> Profile</h3>
        <p><strong>Industry:</strong> <?php echo $company['specialty']; ?></p>
        <p><strong>Bio:</strong> <?php echo $company['bio']; ?></p>
    </div>

    <h3>Your Job Postings</h3>
    <a href="post-job.php" class="btn-primary">Post New Job</a>
    
    <?php
    $jobs = $pdo->prepare("SELECT * FROM jobs WHERE recruiter_id = ?");
    $jobs->execute([$_SESSION['user_id']]);
    while($job = $jobs->fetch()): ?>
        <div class="job-card">
            <h4><?php echo $job['title']; ?></h4>
            <p>Location: <?php echo $job['location']; ?> | Type: <?php echo $job['contract_type']; ?></p>
            <a href="manage-applications.php?job_id=<?php echo $job['id']; ?>">View Applications</a>
        </div>
    <?php endwhile; ?>
</div>