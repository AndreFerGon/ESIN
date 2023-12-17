<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['RemoveFromCart'])) {
    $id = $_POST['id'];

    foreach ($_SESSION['cart'] as $index => $product) {
        if ($product['id'] == $id) {
            if ($product['quantity'] > 1) {
                // Decrease quantity by 1 if it's greater than 1
                $_SESSION['cart'][$index]['quantity'] -= 1;
            } else {
                // Remove the entire product if quantity is 1 or less
                unset($_SESSION['cart'][$index]);
            }

            error_log("Product with ID $id removed from cart.");
            
            // Break out of the loop after processing the first occurrence
            break;
        }
    }
}

header('location: cart.php');
exit();
?>
