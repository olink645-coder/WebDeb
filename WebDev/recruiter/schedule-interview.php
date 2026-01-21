<form action="../backend/actions/schedule_action.php" method="POST">
    <input type="hidden" name="candidate_id" value="<?php echo $_GET['app_id']; ?>">
    
    <label>Interview Date & Time:</label>
    <input type="datetime-local" name="interview_date" required>
    
    <label>Meeting Link (Google Meet/Zoom):</label>
    <input type="url" name="link" placeholder="https://zoom.us/j/..." required>
    
    <button type="submit">Send Invitation</button>
</form>