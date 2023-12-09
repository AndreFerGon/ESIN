<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Technology Store</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="positions.css" />
    <style>
      #cart img {
        width: 50px; /* Adjust the width as needed */
        height: auto; /* Maintain aspect ratio */
      }
      #user img {
        width: 50px; /* Adjust the width as needed */
        height: auto; /* Maintain aspect ratio */
      }
    </style>
  </head>
  <body>
    <header>
      <h1>Technology</h1>
    
    <a id="cart" href="list_cart.php">
        <img src="images/cart.png">        
    </a>
    <a id="user" href="user.php">
        <img src="images/user.png">        
    </a>
    
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
          <li><a href="contacts.php">Contacts</a></li>
          <li><a href="loginregister.php">Login / Register</a></li>
        </ul>
      </div>
    </div>
  </body>
</html>