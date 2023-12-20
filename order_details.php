<?php
session_start();


if (!isset($_GET['purchase_id']) || !is_numeric($_GET['purchase_id'])) {
   
    header("Location: myorders.php");
    exit();
}

try {
    
    $dbh = new PDO('sqlite:sql/DataBase.db');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   
    $purchase_id = $_GET['purchase_id'];
    $getPurchaseDetailsQuery = "SELECT * FROM Purchase WHERE number_ = :purchase_id";
    $stmt = $dbh->prepare($getPurchaseDetailsQuery);
    $stmt->bindParam(':purchase_id', $purchase_id, PDO::PARAM_INT);
    $stmt->execute();
    $purchaseDetails = $stmt->fetch(PDO::FETCH_ASSOC);

  
    $getPurchaseProductsQuery = "SELECT Product.*, Purchase_Products.quantity 
                                 FROM Purchase_Products
                                 JOIN Product ON Purchase_Products.product_id = Product.id
                                 WHERE Purchase_Products.purchase_number = :purchase_id";
    $stmt = $dbh->prepare($getPurchaseProductsQuery);
    $stmt->bindParam(':purchase_id', $purchase_id, PDO::PARAM_INT);
    $stmt->execute();
    $purchaseProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
} finally {
    
    $dbh = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
      
    <link rel="icon" href="images/logo.png" type="image/png">
</head>
<body>
    <?php
    include_once('templates/header&navmenu.php');
    ?>

    <section>
        <h2>Order Details</h2>

        <?php
        if ($purchaseDetails) {
            
            
            echo "<p>Total Price: " . $purchaseDetails['price'] . " €</p>";
            echo "<p>Date: " . date('Y-m-d', $purchaseDetails['date_']) . "</p>";
            echo "<p>Delivery Option: " . $purchaseDetails['delivery_option'] . "</p>";

            if ($purchaseProducts) {
                
                echo '<table>';
                echo '<tr>
                        
                        <th>Model</th>
                        <th>Image</th>
                        <th>Price (€)</th>
                        <th>Quantity</th>
                        <th>Return</th>
                      </tr>';

                foreach ($purchaseProducts as $product) {
                    echo '<tr>';
                    echo '<td><a href="product_details.php?id=' . $product['id'] . '">' . $product['model'] . '</a></td>';
                    echo '<td><img src="images/products/' . $product['id'] . '.png" alt="' . $product['model'] . '"></td>';
                    echo '<td>' . $product['price'] . '</td>';
                    echo '<td>' . $product['quantity'] . '</td>';
                    echo '<td>';
                    echo '<form action="process_return.php?purchase_id=' . $purchase_id . '" method="post">';
                    echo '<input type="hidden" name="product_id" value="' . $product['id'] . '">';
                    echo '<input type="hidden" name="quantity" value="' . $product['quantity'] . '">';
                    echo '<button type="submit">Return</button>';
                    echo '</form>';
                    echo '</td>';
                    echo '</tr>';
                    
                }

                echo '</table>';
            } else {
                echo "<p>No products found for this order.</p>";
            }
        } else {
            echo "<p>Order not found.</p>";
        }
        ?>

    </section>

    <?php
    include_once('templates/footer.php');
    ?>
</body>
</html>
