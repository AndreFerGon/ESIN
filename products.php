<?php
// Home.php
session_start();
?>
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
  <body>       
    <section id="products">
        <h2><?php echo $category; ?></h2>
        <div class="list">
            <?php if ($error_msg == null) { ?>
                <?php foreach ($products as $row) { ?>
                    <article>
                        <a href="product_details.php?id=<?php echo $row['id']; ?>">
                            <h3><?php echo $row['model']; ?></h3>                    
                            <img src="images/products/<?php echo $row['id']; ?>.png" alt="A">
                            <span class="price"><?php echo $row['price']; ?></span>
                        </a>
                   </article>
                <?php } ?>
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
