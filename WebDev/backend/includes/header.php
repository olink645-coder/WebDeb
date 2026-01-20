<?php session_start(); ?>
<header>
    <nav class="navbar">
        <div class="logo">RecruitMe</div>
        <ul class="nav-links">
            <li><a href="/public/index.php">Home</a></li>
            <li><a href="/public/jobs.php">Jobs</a></li>
            <li><a href="/public/contact.php">Contact</a></li>
            
            <?php if(isset($_SESSION['user_id'])): ?>
                <li><a href="/<?php echo $_SESSION['role']; ?>/<?php echo $_SESSION['role']; ?>-dashboard.php">Dashboard</a></li>
                <li><a href="/authentication/logout.php" class="btn-logout">Logout</a></li>
            <?php else: ?>
                <li><a href="/authentication/login.php">Login</a></li>
                <li><a href="/authentication/signup.php" class="btn-signup">Sign Up</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>