<?php
// Home.php
session_start();
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize user input
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = password_hash(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING), PASSWORD_DEFAULT); // Hash the password
    $vat = filter_input(INPUT_POST, 'vat', FILTER_VALIDATE_INT); // Assuming vat is an integer
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);

    try {
        $dbh = new PDO('sqlite:sql/DataBase.db');
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Check if a user with the same username or VAT already exists
        $stmt_username = $dbh->prepare('SELECT COUNT(*) FROM Client WHERE username = ?');
        $stmt_username->execute([$username]);
        $username_count = $stmt_username->fetchColumn();
        
        if ($username_count > 0) {
            // Username already in use, display error message
            $error_msg = 'Username is already in use. Please choose a different username.';
        } else {
            // Username is not in use, proceed with registration
            $stmt_insert = $dbh->prepare('INSERT INTO Client (username, password, vat, address_) VALUES (?, ?, ?, ?)');
            $stmt_insert->execute([$username, $password, $vat, $address]);

            // Redirect to login page after successful registration
            header('Location: login.php');
            exit();
        }
        
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<body>
    
    <section id="registration">
        <h2>Registration</h2>
        <?php
        if (isset($error_msg)) {
            echo '<p style="color: red;">' . $error_msg . '</p>';
        }
        ?>
        <form action="register.php" method="post">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Username" required>
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Password" required minlength="8">
            
            <label for="vat">VAT</label>
            <input type="text" id="vat" name="vat" placeholder="VAT" required>
            
            <label for="address">Address</label>
            <input type="text" id="address" name="address" placeholder="Address" required>
            
            <button type="submit">Register</button>
        </form>
        <p>
            Already a member?
            <a href="login.php">Login</a>
        </p>
    </section>
  
    <?php
    include_once('templates/header&navmenu.php');
    include_once('templates/footer.php');
    ?>
</body>
</html>
