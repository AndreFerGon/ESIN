<section>
    <h2>Shopping Cart</h2>
  
    <?php if(!isset($_SESSION['cart']) || count($_SESSION["cart"]) == 0) { ?>
      <p>No items</p>
    <?php } else { ?>
  
      <table id="cart-table">
        <tr>
          <th></th>
          <th>ID</th>
          <th>Name</th>
          <th>Price</th>
          <th>Quantity</th>
        </tr>
  
        <?php foreach ($_SESSION['cart'] as $product) { ?>
          <tr>
            <td><img src="images/<?php echo $product['id'] ?>.png"></td>
            <td><?php echo $product['id'] ?></td>
            <td><?php echo $product['name'] ?></td>
            <td><?php echo $product['price'] ?></td>
            <td><?php echo $product['quantity'] ?></td>
            <td><a href="addtocart.php?id=<?php echo $product['id']; ?>">X</a></td>
          </tr>
        <?php } ?>
      </table>
  
      <form action="action_checkout.php">
        <button>Checkout</button>
      </form>
  
    <?php } ?>
  
  </section>