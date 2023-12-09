<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Technology Store</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="positions.css" />
  </head>
  <body>
  <header>
      <h1>Technology</h1>
    </header>
    <div id="main">
      <div id="nav">
        <ul>
          <li class="active">
            <a href="Home.php">Home</a>
          </li>
          <li>
            <a href="#">Products</a>
            <div id="sub-menu">
              <ul>
                <li><a href="products.php?cat=1">Laptops</a></li>
                <li><a href="products.php?cat=2">Smartphones</a></li>
                <li><a href="products.php?cat=3">Tablets</a></li>
                <li><a href="products.php?cat=4">Accessories</a></li>
              </ul>
            </div>
          </li>
          <li><a href="">Contacts</a></li>
          <li><a href="loginregister.php">Login / Register</a></li>
        </ul>
      </div>
    </div>    

    <div id="customer-support">
      <h2>Apoio ao cliente</h2>
      <p>
        Na LOJA DE TECNOLOGIA, entendemos que a espera pela chegada dos seus produtos é sempre ansiosa. 
        É por isso que nos empenhamos em proporcionar um envio rápido e eficiente para todos os cantos de Portugal. 
        E a melhor parte? Os portes são completamente gratuitos! Não queremos que preocupações com custos de entrega 
        atrapalhem a sua experiência de compra.
      </p>
      <h3>Trocas e Devoluções Descomplicadas</h3>
      <p>
        Queremos que cada compra seja perfeita, por isso, oferecemos um processo de troca e devolução descomplicado. 
        Se por acaso não ficar completamente satisfeito com o seu produto, temos uma política flexível que permite 
        trocas e devoluções dentro de um prazo razoável. A sua satisfação é a nossa prioridade, e estamos aqui para 
        garantir que cada compra seja uma experiência positiva.
      </p>
      <h3>Garantia de Qualidade em Todos os Produtos</h3>
      <p>
        Na LOJA DE TECNOLOGIA, a qualidade dos produtos é a nossa assinatura. Cada item em nosso catálogo é 
        cuidadosamente selecionado para garantir o melhor em termos de desempenho, durabilidade e inovação tecnológica. 
        Além disso, oferecemos garantia em todos os produtos para que você tenha total tranquilidade. Estamos comprometidos 
        em fornecer apenas o melhor em tecnologia, respaldado pela nossa garantia de qualidade.
      </p>
      <h3>Métodos de Pagamento Seguros e Convenientes</h3>
      <p>
        Facilitamos o processo de pagamento para que a sua experiência de compra seja tão suave quanto possível. 
        Aceitamos diversos métodos de pagamento seguros, desde cartões de crédito até opções de pagamento online. 
        Na LOJA DE TECNOLOGIA, a segurança das suas transações é uma prioridade, e você pode confiar que os seus 
        dados estão protegidos em todas as etapas do processo.
      </p>
      <p>
        Na LOJA DE TECNOLOGIA, não vendemos apenas produtos tecnológicos; oferecemos uma experiência de compra 
        completa, desde o momento em que faz o seu pedido até a entrega do produto à sua porta. Conte connosco para 
        proporcionar tecnologia de ponta, serviços excepcionais e total tranquilidade em todas as suas transações.
      </p>
      </h3>Para mais informações</h3>
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
    <div id="informations">
      <div id="left">
        <img src="images/delivery.png" alt="Delivery" />
        <h2>24 hour delivery</h2>
      </div>

      <div id="center1">
        <img src="images/pickup.png" alt="Pickup" />
        <h2>Store pick up</h2>
      </div>

      <div id="center2">
        <img src="images/tools.png" alt="Repair" />
        <h2>Easy repair service</h2>
      </div>

      <div id="right">
        <img src="images/free.png" alt="shipping" />
        <h2>Free shipping</h2>
      </div>
    </div>

    <div id="options">
      <div id="left">
        <h2>Deliveries</h2>
        <p>
          <a href="deliveries.html">See more</a>
        </p>
      </div>
      <div id="center">
        <h2>Reparation</h2>
        <p>
          <a href="reparation.html">See more</a>
        </p>
      </div>
      <div id="right">
        <h2>About Us</h2>
        <p>
          <a href="aboutus.html">See more</a>
        </p>
      </div>
    </div>

    <div id="footer">
      <span class="author">Technology 2023</span>
    </div>
  </body>
</html>