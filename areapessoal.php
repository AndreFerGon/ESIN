<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Menu Vertical</title>
</head>
<body>
    <div class="menu">
        <ul>
            <li><a href="#">Área Pessoal</a></li>
            <li><a href="#">As minhas encomendas</a></li>
            <li><a href="#">As minhas devoluções</a></li>
            <li><a href="#">As minhas reparações</a></li>
        </ul>
    </div>
</body>
</html>
  <body>
    <div>
      <form>
        <input type="text" placeholder="Username" name="Username" />
        <input type="password" placeholder="Password" name="Password" />
        <input type="submit" value="Login" />
        <p>
          Not a member yet?
          <a href="#">Register</a>
        </p>
      </form>
    </div>
    <?php
   include_once('templates/header&navmenu.php');
   include_once('templates/footer.php');
    ?>
  </body>
</html>