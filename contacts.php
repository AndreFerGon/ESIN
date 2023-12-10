<?php
// Home.php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <body>
    <div id="customer-support">
    <h2>Contact iTEC - We're Here for You!</h2>
      <p>
       At iTEC, we value open communication and are always available to address your questions, concerns, or feedback.
       Your experience is our priority, and we want to ensure that you receive the necessary support whenever you need it.
       Below, you'll find all the contact information to connect with us.
      </p>
      <h3>Our Headquarters</h3>
      <p>
       Innovation Street, 123
       Technopolis, Postal Code 56789-012
       Innovation City, Portugal
      </p>
      <h3>Phone</h3>
      <p>
       +351 123 456 789
      </p>
      <h3>Email</h3>
      <p>
       info@itec.pt
      </p>
      <h3>Service Hours:</h3>
      <p>
       Monday to Friday: 9:00 AM - 6:00 PM
       Saturday: 10:00 AM - 2:00 PM
       Sunday: Closed
      </p>
      <h3>Customer Support: Contact Form</h3>
      <p>
      <form action="process_form.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="message">Message:</label>
        <textarea id="message" name="message" rows="4" required></textarea>
        
        <input type="submit" value="Submit">
      </form>
      </p>   
    </div> 
   

    <?php
   include_once('templates/header&navmenu.php');
   include_once('templates/footer.php');
   include_once('templates/bottombanner.php')
    ?>

    </body>
</html>