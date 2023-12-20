<?php
// Home.php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="styles.css"> 
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
      
    <link rel="icon" href="images/logo.png" type="image/png">
</head>

<body>

  <div id="legal_info">
    <h2>Legal Information</h2>
  </div>

  <div id="legal_info_services">
    <div id="first">
      <img src="images/eletronic_sales.png" alt="Electronic Sales" />
      <h3>Sale of Electronic Products</h3>
      <p>
        The company commits to providing detailed information about electronic products for sale.
      </p>
    </div>

    <div id="second">
      <img src="images/home_delivery.png" alt="Home Delivery" />
      <h3>Home Delivery</h3>
      <p>
        Delivery times are communicated to customers, and the company commits to resolve any problem.
      </p>
    </div>

    <div id="third">
      <img src="images/technical_assistance.png" alt="Technical Assistance" />
      <h3>Warranty and Technical Assistance</h3>
      <p>
        All products sold are covered by a legal warranty and provide technical assistance and repair services.
      </p>
    </div>

    <div id="fourth">
      <img src="images/returns.png" alt="Returns and Refunds" />
      <h3>Returns and Refunds Policy</h3>
      <p>
        The company respects return and refund regulations for defective or unsatisfactory products.
      </p>
    </div>

    <div id="fifth">
      <img src="images/data_protection.png" alt="Data Protection" />
      <h3>Data Protection</h3>
      <p>
        Collected data are used exclusively for commercial and customer support purposes.
      </p>
    </div>

    <div id="sixth">
      <img src="images/resolution.png" alt="Conflict Resolution" />
      <h3>Conflict Prevention and Resolution</h3>
      <p>
        In case of disputes, the company will seek amicable solutions.
      </p>
    </div>
  </div>

  <?php
  include_once('templates/header&navmenu.php');
  include_once('templates/footer.php');
  ?>

</body>

</html>