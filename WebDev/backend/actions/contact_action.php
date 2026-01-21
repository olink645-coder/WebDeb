<?php
require_once '../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Input validation
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST['message']));

    if (!empty($name) && !empty($email) && !empty($message)) {
        // Requirement 3.6: Store in database
        try {
            $sql = "INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$name, $email, $message]);

            // Redirect with success
            header("Location: ../../public/contact.php?status=success");
            exit();
        } catch (PDOException $e) {
            header("Location: ../../public/contact.php?status=error");
            exit();
        }
    } else {
        header("Location: ../../public/contact.php?status=missing_fields");
        exit();
    }
}