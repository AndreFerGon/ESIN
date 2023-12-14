<?php
// Favorites.php
session_start();

try {
    $dbh = new PDO('sqlite:sql/DataBase.db');
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the user is logged in
    
        $user_id = $_SESSION['user_id'];

        // Retrieve the user's favorite products
        $stmt_favorites = $dbh->prepare('SELECT p.* FROM Favorites f INNER JOIN Product p ON f.id = p.id WHERE f.username = ?');
        $stmt_favorites->execute(array($user_id));
        $favorite_products = $stmt_favorites->fetchAll();
    
} catch (PDOException $e) {
    $error_msg = $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <section id="favorites">
        <h2>Your Favorite Products</h2>
        <div class="list">
            <?php if ($error_msg == null && count($favorite_products) > 0) { ?>
                <?php foreach ($favorite_products as $row) { ?>
                    <article>
                        <a href="product_details.php?id=<?php echo $row['id']; ?>">
                            <h3><?php echo $row['model']; ?></h3>
                            <img src="images/products/<?php echo $row['id']; ?>.png" alt="A">
                            <span class="price"><?php echo $row['price']; ?></span>
                        </a>
                    </article>
                <?php } ?>
                <?php } elseif ($error_msg == null) { ?>
                <p>No favorite products found.</p>
            <?php } else {
                echo $error_msg;
            } ?>
        </div>
    </section>

    <?php
   include_once('templates/header&navmenu.php');
   include_once('templates/footer.php');
    ?>
</body>
</html>
