<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Technology Store</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="positions.css" />
</head>
<body>
    <!-- Your existing HTML content -->

    <section id="products">
        <h2>SmartPhones</h2>
        <div class="list">
            <?php
            // Assuming the SQLite database is named "DataBase.db" and is in the same directory as this PHP file
            $db = new SQLite3('DataBase.db');

            // Fetch products from the database
            $query = "SELECT model, price FROM Product WHERE category = (SELECT id FROM Category WHERE name = 'SmartPhone')";
            $result = $db->query($query);

            // Display products
            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                echo '<article>';
                echo '<h3>' . $row['model'] . '</h3>';
                echo '<img src="images/' . $row['model'] . '.png" alt="a product">';
                echo '<span class="price">$' . $row['price'] . '</span>';
                echo '</article>';
            }

            // Close the database connection
            $db->close();
            ?>
        </div>
    </section>

    <div id="footer">
        <span class="author">Technology 2023</span>
    </div>
</body>
</html>
