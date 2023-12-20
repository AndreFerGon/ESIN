<?php
session_start();

try {
    $dbh = new PDO('sqlite:sql/DataBase.db');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    $stmt = $dbh->prepare('SELECT address_, vat FROM Client WHERE username = ?');
    $stmt->execute([$_SESSION['user_id']]);
    $userDetails = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
  
    <link rel="icon" href="images/logo.png" type="image/png">
</head>

<body>

    <div id=user_profile>
        <h2>User Profile</h2>
        <p>Welcome, <?php echo $_SESSION['user_id']; ?>!</p>

        <?php
        if ($userDetails) {
            echo '<p>Address: ' . $userDetails['address_'] . '</p>';
            echo '<p>VAT: ' . $userDetails['vat'] . '</p>';
        } else {
            echo 'Unable to fetch user details.';
        }
        ?>
    </div>

    <?php
    include_once('templates/header&navmenu.php');
    include_once('templates/footer.php');
    include_once('templates/userpages.php');
    ?>
</body>

</html>
