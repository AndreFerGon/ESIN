<?php
session_start();
$userLoggedIn = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>iTEC</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="positions.css" />
    
</head>

<body>
    <header>
        <h1> <img src="images/logo.png" alt="logo">   </h1>

        
        <?php if ($userLoggedIn) { ?>
              <a id="cart" href="cart.php">
                  <img src="images/cart.png" alt="Cart">        
               </a>
        <?php }  ?>
        <?php if ($userLoggedIn) { ?>
               <a id="favorites" href="favorites.php">
                   <img src="images/favorite1.png" alt="User">        
               </a>
        <?php }  ?>
        <?php if ($userLoggedIn) { ?>
               <a id="user" href="user.php">
                   <img src="images/user.png" alt="User">        
               </a>
        <?php }  ?>                      
                
    </header>
    <div id="main">
        <div id="nav">
            <ul>
                <li class="active"><a href="Home.php">Home</a></li>
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
                <li>
                    <?php if ($userLoggedIn) { ?>
                        <a id="user" href="logout.php">
                            Logout                                    
                        </a>
                    <?php } else { ?>
                        <a id="login_button" href="login.php">
                            Login / Register
                        </a>
                    <?php } ?>
                </li>
            </ul>
        </div>
    </div>
</body>
</html>
