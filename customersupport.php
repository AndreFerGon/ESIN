<?php
// Home.php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <body>
    <div id="customer-support">
    <div id="title_costumer_support">
    <h2>Customer Support</h2>
      <p>
        iTEC company understands that the anticipation for the arrival of your products is always exciting.
        That's why we strive to provide fast and efficient shipping to every corner of Portugal.
        And the best part? Shipping is completely free!
      </p>
    </div>
    <div id="exchanges_and_returns">
      <h3>Straightforward Exchanges and Returns</h3>
      <p>
        iTEC wants every purchase to be perfect.
        If, by any chance, you are not completely satisfied with your product, our company have a flexible policy that allows
        exchanges and returns within a reasonable timeframe. Your satisfaction is our priority.
      </p>
    </div>
      <div id="quality">
      <h3>Quality Guarantee on All Products</h3>
      <p>
        AT iTEC, product quality is our signature. Each item in our catalog is carefully selected
        to ensure the best in terms of performance, durability, and technological innovation.
        Additionally, we offer a warranty on all products so that you have complete peace of mind.
      </p>
    </div>
      <div id="payment">
      <h3>Secure and Convenient Payment Methods</h3>
      <p>
       The payment process is easy for a pleasent shopping experience .
      We accept various secure payment methods, from credit cards to online payment options.
      The security of your transactions is a priority.
      </p>
    </div>
      <div id="more_info">
      <h3>For more information</h3>
      <p>
        If you have any questions or concerns, please contact us. We are here to help!
      </p>
      <p><a href="contacts.php">Contacts</a></p>  
    </div> 
    </div> 
   

    <?php
   include_once('templates/header&navmenu.php');
   include_once('templates/footer.php');
    ?>

    </body>
</html>