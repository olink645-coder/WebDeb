<?php 
session_start();
require_once '../backend/includes/db.php'; 

// Get job ID from URL
$job_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Fetch job details securely
$stmt = $pdo->prepare("SELECT * FROM jobs WHERE id = ?");
$stmt->execute([$job_id]);
$job = $stmt->fetch();

if (!$job) {
    die("Job offer not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $job['title']; ?> - Details</title>
    <link rel="stylesheet" href="../backend/css/style.css">
</head>
<body>
    <div class="job-detail-container">
        <h1><?php echo $job['title']; ?></h1>
        <h3>Company: <?php echo $job['company_name']; ?></h3>
        <p><strong>Location:</strong> <?php echo $job['location']; ?></p>
        <p><strong>Contract:</strong> <?php echo $job['contract_type']; ?></p> <div class="description">
            <h4>Description:</h4>
            <p><?php echo nl2br($job['description']); ?></p>
        </div>

        <?php if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'candidate'): ?>
            <form action="../backend/actions/apply_action.php" method="POST">
                <input type="hidden" name="job_id" value="<?php echo $job['id']; ?>">
                <button type="submit" class="btn-apply">Apply Now</button>
            </form>
        <?php elseif (!isset($_SESSION['user_id'])): ?>
            <p><a href="../authentication/login.php">Log in as a Candidate</a> to apply for this job.</p>
        <?php endif; ?>
        
        <br>
        <a href="jobs.php">Back to Job List</a>
    </div>
</body>
</html>