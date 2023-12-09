<!DOCTYPE html>
<html lang="en">
  <body>
    <div id="customer-support">
    <h2>Customer Support</h2>
      <p>
        At TECHNOLOGY STORE, we understand that the anticipation for the arrival of your products is always exciting.
        That's why we strive to provide fast and efficient shipping to every corner of Portugal.
        And the best part? Shipping is completely free! We don't want delivery costs to overshadow your shopping experience.
      </p>
      <h3>Straightforward Exchanges and Returns</h3>
      <p>
        We want every purchase to be perfect, which is why we offer a straightforward exchange and return process.
        If, by any chance, you are not completely satisfied with your product, we have a flexible policy that allows
        exchanges and returns within a reasonable timeframe. Your satisfaction is our priority, and we're here to ensure
        that every purchase is a positive experience.
      </p>
      <h3>Quality Guarantee on All Products</h3>
      <p>
        At TECHNOLOGY STORE, product quality is our signature. Each item in our catalog is carefully selected
        to ensure the best in terms of performance, durability, and technological innovation.
        Additionally, we offer a warranty on all products so that you have complete peace of mind.
        We are committed to providing only the best in technology, backed by our quality guarantee.
      </p>
      <h3>Secure and Convenient Payment Methods</h3>
      <p>
        We make the payment process easy so that your shopping experience is as smooth as possible.
        We accept various secure payment methods, from credit cards to online payment options.
        At TECHNOLOGY STORE, the security of your transactions is a priority, and you can trust that your data
        is protected at every stage of the process.
      </p>
      <p>
        At TECHNOLOGY STORE, we don't just sell technological products; we offer a complete shopping experience,
        from the moment you place your order to the delivery of the product to your doorstep.
        Count on us to provide cutting-edge technology, exceptional services, and total peace of mind in all your transactions.
      </p>
      <h3>For more information</h3>
      <p>
      <form action="process_form.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="message">Message:</label>
        <textarea id="message" name="message" rows="4" required></textarea>
        
        <input type="submit" value="Submit">
      </form>
      </p>   
    </div>  
   

    <?php
   include_once('templates/header&navmenu.php');
   include_once('templates/footer.php');
   include_once('templates/bottombanner.php')
    ?>

    </body>
</html>