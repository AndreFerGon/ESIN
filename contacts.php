<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<body>

  <div id="contacts">
    <div id="title">
      <h2>Contact iTEC - We are here for you!</h2>
      
      <p>
        At iTEC, we value open communication and are always available to address your questions, concerns, or feedback.
        Your experience is our priority, and we want to ensure that you receive the necessary support whenever you need it.
        Below, you'll find all the contact information to connect with us.
      </p>
      <div id="map">
        <img src="images/mapa.png" alt="map">
      </div>
    </div>

    <div id="contacts-details">
      <div id="address">
        <h3>Address</h3>
        <p>
          Rua da Fábica, 123
        </p>
        <p>
          Postal Code 56789-012
        </p>
        <p>
          Porto, Portugal
        </p>
      </div>

      <div id="phone-email">
        <h3>Phone and Email</h3>
        <p>
          +351 123 456 789
        </p>
        <p>
          info@itec.pt
        </p>
      </div>

      <div id="service-hours">
        <h3>Service Hours</h3>
        <p>
          Monday to Friday: 9:00 AM - 6:00 PM
        </p>
        <p>
          Saturday: 10:00 AM - 2:00 PM
        </p>
        <p>
          Sunday: Closed
        </p>
      </div>
    </div>

    <div id="contact-form">
      <h3>Customer Support: Contact Form</h3>
      <?php
      if (isset($_SESSION['success_message'])) {
          echo '<p style="color: green;">' . $_SESSION['success_message'] . '</p>';
          unset($_SESSION['success_message']);
      }
      ?>
      <form action="process_form.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="message">Message:</label>
        <textarea id="message" name="message" rows="4" required></textarea>
        
        <input type="submit" value="Submit">
      </form>
    </div>
  </div>

  <?php
  include_once('templates/header&navmenu.php');
  include_once('templates/footer.php');
  ?>

</body>
</html>