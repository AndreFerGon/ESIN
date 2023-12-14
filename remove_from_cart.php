<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['RemoveFromCart'])) {
    $id = $_POST['id'];

    foreach ($_SESSION['cart'] as $index => $product) {
        if ($product['id'] == $id) {
            unset($_SESSION['cart'][$index]);
        
            error_log("Product with ID $id removed from cart.");
        }
    }
}

header('location: cart.php');
exit();
?>
