<?php
// Home.php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<body>
  <h2>Order In Progress</h2>

<?php
// Check if there are orders
if (!isset($_SESSION['orders']) || count($_SESSION["orders"]) == 0) {
    echo "<p>No orders placed</p>";
} else {
    // Get the latest order (assuming the last one is in progress)
    $latestOrder = end($_SESSION['orders']);
?>
    <div>
        <h3>Order ID: <?php echo $latestOrder['order_id']; ?></h3>
        <p>Status: <?php echo $latestOrder['status']; ?></p>

        <table>
            <tr>
                <th>Product ID</th>
                <th>Model</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
            <?php
            foreach ($latestOrder['products'] as $product) {
            ?>
                <tr>
                    <td><?php echo $product['id']; ?></td>
                    <td><?php echo $product['model']; ?></td>
                    <td><?php echo $product['price']; ?></td>
                    <td><?php echo $product['quantity']; ?></td>
                </tr> <!-- Add this line to close the foreach loop -->
            <?php
            }
            ?>
        </table>
    </div>

    <?php
    include_once('templates/header&navmenu.php');
    include_once('templates/footer.php');
    include_once('templates/bottombanner.php');
    ?>
</body>
</html>