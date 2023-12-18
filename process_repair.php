<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize user input
    $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);
    $device_type = filter_input(INPUT_POST, 'device_type', FILTER_SANITIZE_STRING);
    $brand = filter_input(INPUT_POST, 'brand', FILTER_SANITIZE_STRING);
    $serial_number = filter_input(INPUT_POST, 'serial_number', FILTER_SANITIZE_STRING);
    $reported_issue = filter_input(INPUT_POST, 'reported_issue', FILTER_SANITIZE_STRING);
    $budget = filter_input(INPUT_POST, 'budget', FILTER_VALIDATE_INT);
    $shipping_code = filter_input(INPUT_POST, 'shipping_code', FILTER_VALIDATE_INT);
    $facility_id = filter_input(INPUT_POST, 'facility', FILTER_VALIDATE_INT); // Assuming 'facility' is the name attribute of the <select> element

    try {
        $dbh = new PDO('sqlite:sql/DataBase.db');
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Check if the user is logged in and fetch the client ID
        $client_id = null;
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];

            $stmt_client = $dbh->prepare('SELECT username FROM Client WHERE username = ?');
            $stmt_client->execute([$user_id]);
            $client_id = $stmt_client->fetchColumn();
        }

        // Insert new repair into Reparation table
        $stmt_reparation = $dbh->prepare('INSERT INTO Reparation (date_, client, status, device_type, brand, serial_number, reported_issue, budget, shipping_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt_reparation->execute([$date, $client_id, 'Evaluating', $device_type, $brand, $serial_number, $reported_issue, $budget, $shipping_code]);

        // Get the ID of the last inserted repair
        $last_inserted_id = $dbh->lastInsertId();

        // Check if the facility is not already associated with the repair
        $stmt_check_facility = $dbh->prepare('SELECT COUNT(*) FROM ReparationFacility WHERE facility = ? AND reparation = ?');
        $stmt_check_facility->execute([$facility_id, $last_inserted_id]);
        $facility_exists = $stmt_check_facility->fetchColumn();

        // Insert facility information into ReparationFacility table if not already associated
        if (!$facility_exists) {
            $stmt_facility = $dbh->prepare('INSERT INTO ReparationFacility (facility, reparation) VALUES (?, ?)');
            $stmt_facility->execute([$facility_id, $last_inserted_id]);
        }

        // Redirect back to the repairs page after successful insertion
        header('Location: repairs.php');
        exit();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>
