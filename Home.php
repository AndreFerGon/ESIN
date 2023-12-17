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
        <style>
            /* Add these styles directly in the head section */
            #content {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
            }

            
            .list {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
            }

            article {
                width: 48%;
                margin-bottom: 20px;
            }

            article a {
                display: flex;
                flex-direction: column;              
            }
          
            article img {
                max-width: 100%;
                border-radius: 30%;
            }

            
        </style>
   </head>
   <body>   
    <div id="content">
    <img src="images/promoção.png" alt="Advertisement" />
        
        <div class="list">
            <?php if ($error_msg == null) { ?>
                <?php foreach ($firstProducts as $category_id => $product) { ?>
                    <?php if ($product !== false) { ?>
                        <article style="width: 40%; margin-bottom: 30px;">
                            <a href="product_details.php?id=<?php echo $product['id']; ?>">                 
                                <img src="images/products/<?php echo $product['id']; ?>.png" alt="Product Image" style="border-radius: 30%" >
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
