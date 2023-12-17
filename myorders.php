<?php
session_start();

try {
    // Establish SQLite connection
    $dbh = new PDO('sqlite:sql/DataBase.db');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query to get user's purchases
    $user_id = $_SESSION['user_id'];
    $getUserPurchasesQuery = "SELECT * FROM Purchase WHERE client = :user_id";
    $stmt = $dbh->prepare($getUserPurchasesQuery);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
    $stmt->execute();
    $userPurchases = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
} finally {
    // Close the database connection
    $dbh = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Orders</title>
    <style>
        table {
            width: 100%;
            
            margin-top: 20px;
        }

      

        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <?php
    include_once('templates/header&navmenu.php');
    ?>

    <section>
        <h2>My Orders</h2>

        <?php
        if ($userPurchases) {
            echo '<table>';
            echo '<tr>
                    <th>Purchase ID</th>
                    <th>Total Price (€)</th>
                    <th>Date</th>
                    <th>Delivery Option</th>
                  </tr>';

            foreach ($userPurchases as $purchase) {
                // Display information for each purchase in a table row
                echo '<tr>';
                echo '<td><a href="order_details.php?purchase_id=' . $purchase['number_'] . '">' . $purchase['number_'] . '</a></td>';
                echo '<td>' . $purchase['price'] . '</td>';
                echo '<td>' . date('Y-m-d', $purchase['date_']) . '</td>';
                echo '<td>' . $purchase['delivery_option'] . '</td>';
                echo '</tr>';
            }

            echo '</table>';
        } else {
            echo "<p>No orders found.</p>";
        }
        ?>

    </section>

    <?php
    include_once('templates/footer.php');
    include_once('templates/bottombanner.php');
    ?>
</body>
</html>
