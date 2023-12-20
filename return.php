<?php
session_start();

try {
    $dbh = new PDO('sqlite:sql/DataBase.db');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Assuming you have a user authentication mechanism
    // For example, you can use $_SESSION['user_id'] to identify the logged-in user

    // Fetch returns for the user from the Return table
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        $stmt_returns = $dbh->prepare('SELECT Return.id, Return.date_, Return.purchase_number, Return.product_id, Return.quantity, Product.model
                                       FROM Return
                                       JOIN Product ON Return.product_id = Product.id
                                       JOIN Purchase ON Return.purchase_number = Purchase.number_
                                       WHERE Purchase.client = ?');
        $stmt_returns->execute([$user_id]);
        $returns = $stmt_returns->fetchAll(PDO::FETCH_ASSOC);

        if ($returns) {
            echo '<h2>Returns</h2>';
            echo '<table border="1">';
            echo '<tr><th>ID</th><th>Date</th><th>Purchase Number</th><th>Product Model</th><th>Quantity</th></tr>';
            foreach ($returns as $return) {
                echo '<tr>';
                echo '<td>' . $return['id'] . '</td>';
                echo '<td>' . $return['date_'] . '</td>';
                echo '<td>' . $return['purchase_number'] . '</td>';
                echo '<td>' . $return['model'] . '</td>';
                echo '<td>' . $return['quantity'] . '</td>';
                echo '</tr>';
            }
            echo '</table>';

            
        } else {
            echo '<p>No returns found for the user.</p>';
        }
    } else {
        echo '<p>User not logged in.</p>';
    }
    echo '<a href="myorders.php" class="return-button">Return a Product</a>';
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
} finally {
    // Close the database connection
    $dbh = null;
}
include_once('templates/userpages.php');
include_once('templates/header&navmenu.php');

include_once('templates/footer.php');
?>

