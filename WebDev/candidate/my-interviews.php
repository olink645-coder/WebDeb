<?php 
require_once '../backend/includes/header.php';
require_once '../backend/includes/db.php';

// Fetch interviews from the 'interviews' table
$stmt = $pdo->prepare("SELECT i.*, j.title FROM interviews i 
                       JOIN jobs j ON i.offer_id = j.id 
                       WHERE i.candidate_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$interviews = $stmt->fetchAll();
?>

<div class="container">
    <h2>My Scheduled Interviews</h2>
    <div class="interview-list">
        <?php foreach ($interviews as $iv): ?>
            <div class="interview-card">
                <h4><?php echo $iv['title']; ?></h4>
                <p>Date: <?php echo $iv['interview_date']; ?></p>
                <p>Link: <a href="<?php echo $iv['link']; ?>" target="_blank">Join Meeting</a></p>
                <p>Status: <?php echo $iv['status']; ?></p>
                
                <form action="../backend/actions/respond_interview.php" method="POST" style="box-shadow:none; padding:0; margin:0;">
                    <input type="hidden" name="interview_id" value="<?php echo $iv['id']; ?>">
                    <button name="response" value="Accepted" class="btn-confirm">Confirm</button>
                    <button name="response" value="Rejected" class="btn-decline">Decline</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</div>