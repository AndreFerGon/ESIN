<!DOCTYPE html>
<html lang="en">
  <body>
    <div id="customer-support">
      <h2>Contacte a iTEC - Estamos Aqui para Si!</h2>
      <p>
       Na iTEC, valorizamos a comunicação aberta e estamos sempre disponíveis para atender às suas perguntas, preocupações 
       ou feedback. A sua experiência é a nossa prioridade, e queremos garantir que receba o suporte necessário sempre que 
       precisar. Abaixo encontrará todas as informações de contacto para se conectar connosco.
      </p>
      <h3>A Nossa Sede</h3>
      <p>
       Rua da Inovação, 123
       Tecnópolis, Código Postal 56789-012
       Cidade da Inovação, Portugal
      </p>
      <h3>Telefone</h3>
      <p>
       +351 123 456 789
      </p>
      <h3>Email</h3>
      <p>
       info@itec.pt
      </p>
      <h3>Horário de Atendimento:</h3>
      <p>
       Segunda a Sexta: 9h00 - 18h00
       Sábado: 10h00 - 14h00
       Domingo: Encerrado
      </p>
      <h3>Apoio ao cliente: Formulário de contacto</h3>
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