<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $address = $_POST['address'];
    $deliveryOption = $_POST['delivery_option'];

    // Retrieve products from the cart
    $cartProducts = $_SESSION['cart'];

    try {
        // Establish SQLite connection
        $dbh = new PDO('sqlite:sql/DataBase.db');
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Begin a transaction
        $dbh->beginTransaction();

        // Get user details
        $user_id = $_SESSION['user_id'];
        $getUserDetailsQuery = "SELECT * FROM Client WHERE username = :user_id";
        $stmt = $dbh->prepare($getUserDetailsQuery);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $stmt->execute();
        $userDetails = $stmt->fetch(PDO::FETCH_ASSOC);

        // Insert data into Purchase table
        $totalPrice = 0;
        foreach ($cartProducts as $product) {
            $totalPrice += $product['price'] * $product['quantity'];
        }

        $insertPurchaseQuery = "INSERT INTO Purchase (price, date_, client, delivery_option) 
                                VALUES ($totalPrice, strftime('%s', 'now'), :user_id, '$deliveryOption')";
        $stmt = $dbh->prepare($insertPurchaseQuery);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $stmt->execute();

        // Get the last inserted purchase number
        $purchaseNumber = $dbh->lastInsertId();

        // Insert data into Purchase_Products table
        foreach ($cartProducts as $product) {
            $productId = $product['id'];
            $quantity = $product['quantity'];

            $insertPurchaseProductsQuery = "INSERT INTO Purchase_Products (purchase_number, product_id, quantity) 
                                           VALUES ($purchaseNumber, $productId, $quantity)";
            $dbh->exec($insertPurchaseProductsQuery);
        }

        // Commit the transaction
        $dbh->commit();

        // After successful processing, clear the cart
        $_SESSION['cart'] = array();

        // Redirect to the "My Orders" page
        header("Location: Home.php");
        exit();
    } catch (PDOException $e) {
        // Rollback the transaction on error
        $dbh->rollBack();
        echo "Error: " . $e->getMessage();
    } finally {
        // Close the database connection
        $dbh = null;
    }
}
?>
