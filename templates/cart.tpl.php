<section>
  <h2>Shopping Cart</h2>

  <?php if (!isset($_SESSION['cart']) || count($_SESSION["cart"]) == 0) { ?>
      <p>No items</p>
  <?php } else { ?>

      <table id="cart-table">

          <?php
          $totalPrice = 0; // Inicializa o preço total

          foreach ($_SESSION['cart'] as $product) {
              $totalPrice += $product['price'] * $product['quantity']; // Soma o preço do produto ao total
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

      <form action="Check-out.php">
          <button>Checkout</button>
      </form>

  <?php } ?>

</section>
