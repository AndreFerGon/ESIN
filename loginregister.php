<!DOCTYPE html>
<html lang="en">
  
  <body>
    <div>
      <form>
        <input type="text" placeholder="Username" name="Username" />
        <input type="password" placeholder="Password" name="Password" />
        <input type="submit" value="Login" />
        <p>
          Not a member yet?
          <a href="areapessoal.php">Register</a>
        </p>
      </form>
    </div>
    <?php
   include_once('templates/header&navmenu.php');
   include_once('templates/footer.php');
    ?>
  </body>
</html>