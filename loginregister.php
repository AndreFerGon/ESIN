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
      <form>
        <input type="text" placeholder="Username" name="Username" />
        <input type="password" placeholder="Password" name="Password" />
        <input type="submit" value="Login" />
        <p>
          Not a member yet?
          <a href="#">Register</a>
        </p>
      </form>
    </div>
    <div id="footer">
      <span class="author">Technology 2023</span>
    </div>
  </body>
</html>