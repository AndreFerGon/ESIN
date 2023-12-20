<?php
session_start();
$userLoggedIn = isset($_SESSION['user_id']);
?>
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

if ($userLoggedIn && isset($_POST['favorite_submit'])) {
    try {
        $stmt_check_favorite = $dbh->prepare('SELECT * FROM Favorites WHERE username = ? AND id = ?');
        $stmt_check_favorite->execute(array($_SESSION['user_id'], $product_id));
        $is_favorite = $stmt_check_favorite->fetch();

        if ($is_favorite) {
            
            $stmt_remove_favorite = $dbh->prepare('DELETE FROM Favorites WHERE username = ? AND id = ?');
            $stmt_remove_favorite->execute(array($_SESSION['user_id'], $product_id));
            $debug_message = "Product removed from favorites";
        } else {
           
            $stmt_add_favorite = $dbh->prepare('INSERT INTO Favorites (username, id) VALUES (?, ?)');
            $stmt_add_favorite->execute(array($_SESSION['user_id'], $product_id));
            $debug_message = "Product added to favorites";
        }
    } catch (PDOException $e) {
        $error_msg = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css" />
     
    <link rel="icon" href="images/logo.png" type="image/png">
</head>
<body>

<section id="product-details">
    <?php if (isset($product_details) && !empty($product_details)) { ?>
        <h2><?php echo $product_details['model']; ?></h2>
        <img src="images/products/<?php echo $product_details['id']; ?>.png" alt="<?php echo $product_details['model']; ?>">
        <p><?php echo $product_details['specs']; ?></p>
        <p>Price: <?php echo $product_details['price']. ' €'; ?></p>

        <?php if ($userLoggedIn) { ?>
            <form action="addtocart.php" method="post">
    <input type="hidden" name="id" value="<?php echo $product_details['id']; ?>">
    <input type="hidden" name="model" value="<?php echo $product_details['model']; ?>">
    <input type="hidden" name="price" value="<?php echo  $product_details['price']; ?>">
    <input type="number" name="quantity" value="1" min="1">
    <button type="submit" name="Carrinho_submit">Add to cart</button>
</form>

            <form action="" method="post">
                <button type="submit" name="favorite_submit" >Add to favorites 
                </button>
                <p id="debugMessage"><?php echo isset($debug_message) ? $debug_message : ''; ?></p>
            </form>
        <?php } else { ?>
            <form id="loginForm" action="Login.php" method="post">
                <button type="button" onclick="redirectToLogin()">Add to cart</button>
                <button type="button" onclick="redirectToLogin()">Add to favorites</button>
            </form>

            <script>
                function redirectToLogin() {
                    window.location.href = 'Login.php';
                }
            </script>
        <?php } ?>

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
