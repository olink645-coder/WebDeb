<div class="container">
    <h2>Post a New Job Offer</h2>
    <form action="../backend/actions/post_job_action.php" method="POST">
        <input type="text" name="title" placeholder="Job Title" required>
        <input type="text" name="location" placeholder="Location" required>
        
        <select name="contract_type">
            <option value="Full-time">Full-time</option>
            <option value="Part-time">Part-time</option>
            <option value="Internship">Internship</option>
        </select>

        <textarea name="description" placeholder="Job Description" required></textarea>

        <hr>
        <h3>Filtering Requirements</h3>
        <input type="text" name="required_skills" placeholder="Required Skills (e.g., PHP, SQL)">
        <select name="required_level">
            <option value="Beginner">Beginner</option>
            <option value="Intermediate">Intermediate</option>
            <option value="Advanced">Advanced</option>
        </select>
        
        <button type="submit" class="btn-primary">Publish Offer</button>
    </form>
</div>