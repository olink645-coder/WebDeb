<?php 
require_once '../backend/includes/header.php'; // Includes session_start() and DB
require_once '../backend/includes/db.php';

if ($_SESSION['role'] !== 'candidate') { header("Location: ../authentication/login.php"); exit(); }

$user_id = $_SESSION['user_id'];

// Requirement 3.3: Show all applications submitted with status
$stmt = $pdo->prepare("SELECT a.*, j.title, j.company_name 
                       FROM applications a 
                       JOIN jobs j ON a.job_id = j.id 
                       WHERE a.candidate_id = ?");
$stmt->execute([$user_id]);
$applications = $stmt->fetchAll();
?>

<div class="container">
    <h1>Welcome, <?php echo $_SESSION['name']; ?></h1>
    
    <h3>My Applications</h3>
    <table>
        <tr>
            <th>Job Title</th>
            <th>Company</th>
            <th>Status</th>
        </tr>
        <?php foreach ($applications as $app): ?>
        <tr>
            <td><?php echo $app['title']; ?></td>
            <td><?php echo $app['company_name']; ?></td>
            <td><span class="status-<?php echo $app['status']; ?>"><?php echo $app['status']; ?></span></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>