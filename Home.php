<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Technology Store</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="positions.css" />
  </head>
  <body>
  <header>
      <h1>Technology</h1>
    </header>
    <div id="main">
      <div id="nav">
        <ul>
          <li class="active">
            <a href="Home.php">Home</a>
          </li>
          <li>
            <a href="#">Products</a>
            <div id="sub-menu">
              <ul>
                <li><a href="products.php?cat=1">Laptops</a></li>
                <li><a href="products.php?cat=2">Smartphones</a></li>
                <li><a href="products.php?cat=3">Tablets</a></li>
                <li><a href="products.php?cat=4">Accessories</a></li>
              </ul>
            </div>
          </li>
          <li><a href="">Contacts</a></li>
          <li><a href="loginregister.php">Login / Register</a></li>
        </ul>
      </div>
    </div>    

    <div id="content">
      <img src="images/promoção.png" alt="Advertisement" />
    </div>

    <div id="informations">
      <div id="left">
        <img src="images/delivery.png" alt="Delivery" />
        <h2>24 hour delivery</h2>
      </div>

      <div id="center1">
        <img src="images/pickup.png" alt="Pickup" />
        <h2>Store pick up</h2>
      </div>

      <div id="center2">
        <img src="images/tools.png" alt="Repair" />
        <h2>Easy repair service</h2>
      </div>

      <div id="right">
        <img src="images/free.png" alt="shipping" />
        <h2>Free shipping</h2>
      </div>
    </div>

    <div id="options">
      <div id="left">
        <h2>Deliveries</h2>
        <p>
          <a href="deliveries.html">See more</a>
        </p>
      </div>
      <div id="center">
        <h2>Reparation</h2>
        <p>
          <a href="reparation.html">See more</a>
        </p>
      </div>
      <div id="right">
        <h2>About Us</h2>
        <p>
          <a href="apoioaocliente.php">See more</a>
        </p>
      </div>
    </div>



    <div id="footer">
      <span class="author">Technology 2023</span>
    </div>
  </body>
</html>