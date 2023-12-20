<?php
// Home.php
session_start();
?>

<?php

try {
    $dbh = new PDO('sqlite:sql/DataBase.db');
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retrieve all categories
    $stmt_categories = $dbh->prepare('SELECT id, name FROM Category');
    $stmt_categories->execute();
    $categories = $stmt_categories->fetchAll();

    // Array to store the first product from each category
    $firstProducts = array();

    foreach ($categories as $category) {
        // Retrieve the first product for each category
        $stmt_first_product = $dbh->prepare('SELECT * FROM Product WHERE category=? LIMIT 1');
        $stmt_first_product->execute(array($category['id']));
        $firstProduct = $stmt_first_product->fetch();

        // Store the first product in the array
        $firstProducts[$category['id']] = $firstProduct;
    }

} catch (PDOException $e) {
    $error_msg = $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   </head>
   <body>   
    <div id="content">
    <div id=promo>
    <img src="images/promo.jpeg" alt="promo" />
    </div>
        
    <div class="list">
    <?php if ($error_msg == null) { ?>
        <?php foreach ($firstProducts as $category_id => $product) { ?>
            <?php if ($product !== false) { ?>
                <article>
                    <a href="product_details.php?id=<?php echo $product['id']; ?>">                 
                        <img class="image" src="images/products/<?php echo $product['id']; ?>.png" alt="Product Image">
                        <?php echo $product['model']; ?>
                    </a>
                </article>
            <?php } ?>
        <?php } ?>
    <?php } else {
        echo $error_msg;
    } ?>
</div>
</div>
  
    <?php
    include_once('templates/header&navmenu.php');
    include_once('templates/footer.php');
    include_once('templates/bottombanner.php');
    ?>
  </body>
</html>
