<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$base_url = "/recruitment_platform/"; 
?>
<header>
    <nav class="navbar">
        <div class="logo">RecruitMe</div>
        <ul class="nav-links">
            <li><a href="<?php echo $base_url; ?>public/index.php">Home</a></li>
            <li><a href="<?php echo $base_url; ?>public/jobs.php">Jobs</a></li>
            <li><a href="<?php echo $base_url; ?>public/contact.php">Contact</a></li>
            
            <?php if(isset($_SESSION['user_id'])): ?>
                <li><a href="<?php echo $base_url . $_SESSION['role']; ?>/<?php echo $_SESSION['role']; ?>-dashboard.php">Dashboard</a></li>
                <li><a href="<?php echo $base_url; ?>authentication/logout.php" class="btn-logout">Logout</a></li>
            <?php else: ?>
                <li><a href="<?php echo $base_url; ?>authentication/login.php">Login</a></li>
                <li><a href="<?php echo $base_url; ?>authentication/signup.php" class="btn-signup">Sign Up</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>