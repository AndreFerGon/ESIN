<?php
// Home.php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <body>
  <section>
        <h2>Checkout</h2>

        <?php
        // Check if the cart is empty
        if (!isset($_SESSION['cart']) || count($_SESSION["cart"]) == 0) {
            echo "<p>No items in the cart</p>";
        } else {
            $totalPrice = 0; // Initialize the total price
        ?>
            <table id="cart-table">
                <?php
                foreach ($_SESSION['cart'] as $product) {
                    $totalPrice += $product['price'] * $product['quantity'];
                ?>
                    <tr>
                        <td><img src="images/products/<?php echo $product['id'] ?>.png"></td>
                        <td><?php echo $product['id'] ?></td>
                        <td><?php echo $product['model'] ?></td>
                        <td><?php echo $product['price'] ?></td>
                        <td><?php echo $product['quantity'] ?></td>
                        <td>
                            <form action="remove_from_cart.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                                <button type="submit" name="RemoveFromCart">Remove</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>

            <p>Total: <?php echo $totalPrice ?></p>

            <!-- Form to enter the shipping address -->
            <form action="Encomendas.php" method="post">
              <label for="address">Shipping Address:</label>
              <textarea name="address" id="address" rows="4" cols="50" required></textarea>
              <button type="submit">Complete Purchase</button>
            </form>
        <?php } ?>

        <?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lógica de processamento do pedido aqui

    // Após o processamento bem-sucedido, limpe o carrinho
    $_SESSION['cart'] = array();

    // Redirecionar para a página de "My Orders"
    header("Location: Orders.php");
    exit();
}
?>

    </section>
    

    <?php
   include_once('templates/header&navmenu.php');
   include_once('templates/footer.php');
   include_once('templates/bottombanner.php')
    ?>

    </body>
</html>