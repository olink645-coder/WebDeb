<?php require_once '../backend/includes/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Browse Jobs</title>
    <link rel="stylesheet" href="../backend/css/style.css">
</head>
<body>
    <h2>Available Job Offers</h2>
    
    <form method="GET" action="jobs.php" class="search-box">
        <input type="text" name="keyword" placeholder="Search by title...">
        <input type="text" name="location" placeholder="Location">
        <button type="submit">Filter</button>
    </form>

    <div class="job-list">
        <?php
        // Logic to fetch jobs based on filters
        $query = "SELECT * FROM jobs WHERE 1=1";
        if(!empty($_GET['keyword'])) { $query .= " AND title LIKE :kw"; }
        
        $stmt = $pdo->prepare($query);
        if(!empty($_GET['keyword'])) { $stmt->bindValue(':kw', '%'.$_GET['keyword'].'%'); }
        $stmt->execute();

        while($job = $stmt->fetch()): ?>
            <div class="job-card">
                <h3><?php echo $job['title']; ?></h3>
                <p><strong>Company:</strong> <?php echo $job['company_name']; ?></p>
                <p><strong>Location:</strong> <?php echo $job['location']; ?></p>
                <p><?php echo substr($job['description'], 0, 100); ?>...</p>
                <a href="job-details.php?id=<?php echo $job['id']; ?>">View More</a>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>