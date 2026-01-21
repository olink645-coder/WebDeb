<?php 
require_once '../backend/includes/header.php';
require_once '../backend/includes/db.php';

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
?>

<div class="container">
    <h2>Edit Profile</h2>
    <form action="../backend/actions/update_profile.php" method="POST" enctype="multipart/form-data">
        <label>Specialty/Field:</label>
        <input type="text" name="specialty" value="<?php echo $user['specialty']; ?>">
        
        <label>Short Bio:</label>
        <textarea name="bio"><?php echo $user['bio']; ?></textarea>

        <hr>
        <h3>Matching Criteria</h3>
        
        <label>Skills (tags, comma separated):</label>
        <input type="text" name="skills_tags" placeholder="PHP, SQL, Management" value="<?php echo $user['skills_tags']; ?>">
        
        <label>Experience Duration (Years):</label>
        <input type="number" name="experience_years" value="<?php echo $user['experience_years']; ?>">
        
        <label>Experience Level:</label>
        <select name="experience_level">
            <option value="Beginner" <?php if($user['level'] == 'Beginner') echo 'selected'; ?>>Beginner</option>
            <option value="Intermediate" <?php if($user['level'] == 'Intermediate') echo 'selected'; ?>>Intermediate</option>
            <option value="Advanced" <?php if($user['level'] == 'Advanced') echo 'selected'; ?>>Advanced</option>
        </select>

        <button type="submit" class="btn-primary">Update Profile</button>
    </form>
</div>