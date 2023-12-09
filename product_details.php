<?php

$product_id = $_GET['id'];

try {
    $dbh = new PDO('sqlite:sql/DataBase.db');
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    $stmt_product_details = $dbh->prepare('SELECT * FROM Product WHERE id = ?');
    $stmt_product_details->execute(array($product_id));
    $product_details = $stmt_product_details->fetch();

} catch (PDOException $e) {
    $error_msg = $e->getMessage();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css" />
   </head>
<body>

<section id="product-details">
    <?php if (isset($product_details) && !empty($product_details)) { ?>
        <h2><?php echo $product_details['model']; ?></h2>
        <img src="images/products/<?php echo $product_details['id']; ?>.png" alt="<?php echo $product_details['model']; ?>">
        <p><?php echo $product_details['description']; ?></p>
        <p>Price: <?php echo $product_details['price']; ?></p>
    <?php } else { ?>
        <p>Product not found.</p>
    <?php } ?>
</section>

<?php
include_once('templates/header&navmenu.php');
include_once('templates/footer.php');
?>

</body>
</html>