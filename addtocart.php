<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if (isset($_POST['Carrinho_submit'])) {
    $new_product = array(
        'id' => $_POST['id'],
        'model' => $_POST['model'],
        'price' => $_POST['price'],
        'quantity' => $_POST['quantity']
    );

    $new_product_id = $_POST['id'];
    if (array_key_exists($new_product_id, $_SESSION['cart'])) {
        $_SESSION['cart'][$new_product_id]['quantity'] += $new_product['quantity'];
    } else {
        $_SESSION['cart'][$new_product_id] = $new_product;
    }

    header('location: Home.php');
    exit();
}
?>
