<?php
// process_return.php

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have a valid PDO connection earlier in your code
    try {
        $dbh = new PDO('sqlite:sql/DataBase.db');
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Retrieve product_id and quantity from the form submission
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        // Obtain the purchase_id from the URL parameter
        if (isset($_GET['purchase_id']) && !empty($_GET['purchase_id'])) {
            $purchase_id = $_GET['purchase_id'];

            // Insert a new row into the Return table
            $insertReturnQuery = "INSERT INTO Return (date_, purchase_number, product_id, quantity)
                                  VALUES (:date_, :purchase_number, :product_id, :quantity)";
            $stmt = $dbh->prepare($insertReturnQuery);
            $stmt->bindParam(':date_', date('Y-m-d'), PDO::PARAM_STR);
            $stmt->bindParam(':purchase_number', $purchase_id, PDO::PARAM_INT);  
            $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $stmt->execute();

            header("Location: Home.php");
            exit();
        } else {
            echo "Error: Missing or invalid purchase_id parameter.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        // Close the database connection
        $dbh = null;
    }
}
?>
