<?php
$category_id = $_GET['cat'];

try {
    $dbh = new PDO('sqlite:sql/DataBase.db');
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retrieve the category name based on the category_id
    $stmt_category = $dbh->prepare('SELECT name FROM Category WHERE id=?');
    $stmt_category->execute(array($category_id));
    $category = $stmt_category->fetchColumn();

    // Retrieve products for the specified category
    $stmt_products = $dbh->prepare('SELECT * FROM Product WHERE category=?');
    $stmt_products->execute(array($category_id));
    $products = $stmt_products->fetchAll();


} catch (PDOException $e) {
    $error_msg = $e->getMessage();
}
?>

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

    
    <section id="products">
        <h2><?php echo $category; ?></h2>
        <div class="list">
            <?php if ($error_msg == null) { ?>
                <?php foreach ($products as $row) { ?>
                    <article>
                        <h3><?php echo $row['model']; ?></h3>
                        <img src="images/1.png" alt="Smartphone Image">
                        <span class="price"><?php echo $row['price']; ?></span>
                    </article>
                <?php } ?>
            <?php } else {
                echo $error_msg;
            } ?>
        </div>
    </section>

    <div id="footer">
        <span class="author">Technology 2023</span>
    </div>
</body>
</html>
