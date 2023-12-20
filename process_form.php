<?php
// process_form.php

session_start();

// Validate form data
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$username = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'guest';

try {
    // Connect to SQLite database
    $dbh = new PDO('sqlite:sql/DataBase.db');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Using prepared statement to prevent SQL injection
    $stmt = $dbh->prepare("INSERT INTO user_messages (username, name, email, message) VALUES (?, ?, ?, ?)");
    $stmt->bindParam(1, $username, PDO::PARAM_STR);
    $stmt->bindParam(2, $name, PDO::PARAM_STR);
    $stmt->bindParam(3, $email, PDO::PARAM_STR);
    $stmt->bindParam(4, $message, PDO::PARAM_STR);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Form submitted successfully!";
        echo "<script>window.location.href='contacts.php';</script>";
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }

    // Close the database connection
    $dbh = null;
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
