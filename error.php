<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
       
</head>
<body>
    <?php
    
    include_once('templates/header&navmenu.php');
    ?>

    <section>
        <h1>Oops! Something went wrong...</h1>
        <p><?php echo urldecode($_GET['message']); ?></p>
        <p>It's impossible to return an already returned product. Maybe it's time to invent a time machine?</p>
        <p><a href="Home.php">Go back to Home</a></p>
    </section>

    <?php
    include_once('templates/footer.php');
    ?>
</body>
</html>
