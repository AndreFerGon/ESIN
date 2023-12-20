<?php

session_start();
?>
<?php
$category_id = $_GET['cat'];

$productsPerPage = 4;

try {
    $dbh = new PDO('sqlite:sql/DataBase.db');
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   
    $stmt_category = $dbh->prepare('SELECT name FROM Category WHERE id=?');
    $stmt_category->execute(array($category_id));
    $category = $stmt_category->fetchColumn();

    
    $stmt_count_products = $dbh->prepare('SELECT COUNT(*) FROM Product WHERE category=?');
    $stmt_count_products->execute(array($category_id));
    $totalProducts = $stmt_count_products->fetchColumn();

    
    $totalPages = ceil($totalProducts / $productsPerPage);

    
    $currentPage = isset($_GET['page']) ? max(1, $_GET['page']) : 1;

   
    $offset = ($currentPage - 1) * $productsPerPage;

    
    $stmt_products = $dbh->prepare('SELECT * FROM Product WHERE category=? LIMIT ? OFFSET ?');
    $stmt_products->execute(array($category_id, $productsPerPage, $offset));
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
                            <img src="images/products/<?php echo $row['id']; ?>.png" alt="A">
                            <h3><?php echo $row['model']; ?></h3>             
                            <span class="price"><?php echo $row['price']. ' €'; ?></span>       
                        </a>
                   </article>
                <?php } ?>
            <?php } else {
                echo $error_msg;
            } ?>
        </div>

       
        <div class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                <a href="?cat=<?php echo $category_id; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
            <?php } ?>
        </div>
    </section>

    <?php
    include_once('templates/header&navmenu.php');
    include_once('templates/footer.php');
    ?>
</body>
</html>
