<?php
// Home.php
session_start();
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize user input
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    try {
        $dbh = new PDO('sqlite:sql/DataBase.db');
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Retrieve user information based on the provided username
        $stmt = $dbh->prepare('SELECT * FROM Client WHERE username = ?');
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Successful login
            // You may want to set session variables or perform other actions here
            $_SESSION['user_id'] = $user['username'];
            // Redirect to a welcome or dashboard page
            header('Location: Home.php');
            exit();
        } else {
            // Invalid username or password
            echo 'Invalid username or password. Please try again.';
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<body>
    <div>
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
