<?php
require_once '../backend/includes/header.php';
require_once '../backend/includes/db.php';

$job_id = (int)$_GET['job_id'];

// 1. Fetch Job Requirements first
$jobStmt = $pdo->prepare("SELECT required_skills FROM jobs WHERE id = ?");
$jobStmt->execute([$job_id]);
$job = $jobStmt->fetch();
$required_skills = array_map('strtolower', array_map('trim', explode(',', $job['required_skills'])));

// 2. Fetch Applications for this job
$sql = "SELECT a.*, u.name, u.skills_tags, u.experience_level 
        FROM applications a 
        JOIN users u ON a.candidate_id = u.id 
        WHERE a.job_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$job_id]);
$candidates = $stmt->fetchAll();
?>

<div class="container">
    <h3>Applications for Job #<?php echo $job_id; ?></h3>
    <table>
        <tr>
            <th>Candidate</th>
            <th>Match Status</th>
            <th>Action</th>
        </tr>
        <?php foreach($candidates as $c): 
            // 3. Matching Algorithm Logic
            $candidate_skills = array_map('strtolower', array_map('trim', explode(',', $c['skills_tags'])));
            $matched_skills = array_intersect($required_skills, $candidate_skills);
            
            $score = count($matched_skills);
            $total_required = count($required_skills);

            // Determine Status [Requirement 8]
            if ($score === $total_required && $total_required > 0) {
                $status_label = "100% Match";
                $css_class = "match-full";
            } elseif ($score > 0) {
                $status_label = "Partial Match ($score/$total_required)";
                $css_class = "match-partial";
            } else {
                $status_label = "Non-match";
                $css_class = "match-none";
            }
        ?>
        <tr>
            <td><?php echo htmlspecialchars($c['name']); ?></td>
            <td><span class="badge <?php echo $css_class; ?>"><?php echo $status_label; ?></span></td>
            <td>
                <a href="schedule-interview.php?app_id=<?php echo $c['id']; ?>&job_id=<?php echo $job_id; ?>" class="btn-small">Schedule</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>