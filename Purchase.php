<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $address = $_POST['address'];
    $deliveryOption = $_POST['delivery_option'];

   
    $cartProducts = $_SESSION['cart'];

    try {
        
        $dbh = new PDO('sqlite:sql/DataBase.db');
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $dbh->beginTransaction();

        
        $user_id = $_SESSION['user_id'];
        $getUserDetailsQuery = "SELECT * FROM Client WHERE username = :user_id";
        $stmt = $dbh->prepare($getUserDetailsQuery);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $stmt->execute();
        $userDetails = $stmt->fetch(PDO::FETCH_ASSOC);

        
        $totalPrice = 0;
        foreach ($cartProducts as $product) {
            $totalPrice += $product['price'] * $product['quantity'];
        }

        $insertPurchaseQuery = "INSERT INTO Purchase (price, date_, client, delivery_option) 
                                VALUES ($totalPrice, strftime('%s', 'now'), :user_id, '$deliveryOption')";
        $stmt = $dbh->prepare($insertPurchaseQuery);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $stmt->execute();

        
        $purchaseNumber = $dbh->lastInsertId();

       
        foreach ($cartProducts as $product) {
            $productId = $product['id'];
            $quantity = $product['quantity'];

            $insertPurchaseProductsQuery = "INSERT INTO Purchase_Products (purchase_number, product_id, quantity) 
                                           VALUES ($purchaseNumber, $productId, $quantity)";
            $dbh->exec($insertPurchaseProductsQuery);
        }

        
        $dbh->commit();

        
        $_SESSION['cart'] = array();

        
        header("Location: Home.php");
        exit();
    } catch (PDOException $e) {
        
        $dbh->rollBack();
        echo "Error: " . $e->getMessage();
    } finally {
        
        $dbh = null;
    }
}
?>
