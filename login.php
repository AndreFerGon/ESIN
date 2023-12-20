<?php
session_start();
?>
<?php
$errorMsg = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    try {
        $dbh = new PDO('sqlite:sql/DataBase.db');
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

       
        $stmt = $dbh->prepare('SELECT * FROM Client WHERE username = ?');
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            
            $_SESSION['user_id'] = $user['username'];
           
            header('Location: Home.php');
            exit();
        } else {
           
            $errorMsg = 'Invalid username or password. Please try again.';
        }
    } catch (PDOException $e) {
        $errorMsg = 'Error: ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>       
    <link rel="icon" href="images/logo.png" type="image/png">
</head>
<body>
    <div id=login>
        <h2>Login</h2>
        <?php
        
        echo '<p style="color: red;">' . $errorMsg . '</p>';
        ?>
        <form action="login.php" method="post">
            <input type="text" placeholder="Username" name="username" required />
            <input type="password" placeholder="Password" name="password" required />
            <input type="submit" value="Login" />
        </form>
        <p>
            Not a member yet?
            <a href="register.php">Register</a>
        </p>
    </div>

    <?php
    include_once('templates/header&navmenu.php');
    include_once('templates/footer.php');
    ?>
</body>

</html>
