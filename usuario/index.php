<!DOCTYPE html>
<html lang="en">
<!-- HOME DEL USUARIO -->
<head>
  <title>Usuario-WP</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <style>
  *{
    font-family: Arial;
  }
  #cabeza{
    background: blue; /* For browsers that do not support gradients */
    background: -webkit-linear-gradient(left, #0ba7f0 , #493ed2); /* For Safari 5.1 to 6.0 */
    background: -o-linear-gradient(right, #0ba7f0, #493ed2); /* For Opera 11.1 to 12.0 */
    background: -moz-linear-gradient(right, #0ba7f0, #493ed2); /* For Firefox 3.6 to 15 */
    background: linear-gradient(to right, #0ba7f0 , #493ed2); /* Standard syntax */
  }

  .rojoFondo{
    background: red; /* For browsers that do not support gradients */
    background: -webkit-linear-gradient(left, #fb4b12 , #ff8900); /* For Safari 5.1 to 6.0 */
    background: -o-linear-gradient(right, #fb4b12, #ff8900); /* For Opera 11.1 to 12.0 */
    background: -moz-linear-gradient(right, #fb4b12, #ff8900); /* For Firefox 3.6 to 15 */
    background: linear-gradient(to right, #fb4b12 , #ff8900); /* Standard syntax */
    color: white;
  }
  .rojoLetra{
    color: #fb4b12;
  }
  .grisFondo{
    background: #f0f0f0;
  }

  .humText{
    color: #267eed;
  }
  .lluvText{
    color: #5048de;
  }
  .lumText{
    color: #e88c18;
  }
  .preText{
    color: #011d34;
  }

  .humFondo{
    background: #267eed;
    color: white;
  }
  .lluvFondo{
    background: #5048de;
    color: white;
  }
  .lumFondo{
    background: #e88c18;
    color: white;
  }
  .preFondo{
    background: #011d34;
    color: white;
  }
  #titulo{
    color: #011d34;
    font-size: 70px;
    display: inline;
    margin-left: 30px;
  }
  header a{
    color: white;
   /* margin-top: 25px;
    margin-right: 20px;*/
    font-size: 1rem;
  }
  ul{
    text-align: center;
  }

  ul#barra {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
  }

  ul#barra > li {
      float: left;
  }

  ul#barra > li a {
      display: block;
      color: white;
      text-align: center;
      padding: 10px 16px;
      text-decoration: none;
  }

  ul#barra > li a:hover:not(.active) {
      background-color: #111;
  }
  </style>
</head>
<body onresize="flag()">
<?php
    session_start();
    // unset($_SESSION['nombre']);
    $nombre = $_SESSION['nombre'];
    // echo '<script> alert(' . $nombre . ");</script>";
  //   unset($_SESSION['nombre']);
  // session_destroy();
    if(!isset($nombre) )
    {
      header("Location: ../");
    }

    if(isset($_POST['registrar']))
    {
      // $con = new mysqli("localhost","root","","practica");
      $con = new mysqli("mysql.hostinger.mx","u437869613_noe","/*gallo*/","u437869613_pi");
      if ($con->connect_error) {
        echo "<script>alert('Error al conectar a base de datos')</script>";
          // die("Connection failed: " . $con->connect_error);
      }
      else
      {
        $nameuser = $_POST['nameuser'];
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $password = mysqli_real_escape_string($con,$_POST['password']);

        $salt = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
        $saltedPW = $password . $salt;
        $hashedPW = hash('sha256', $saltedPW);
        $sql = "INSERT INTO users (nameuser, fullname, email, salt, password)
                  VALUES
                  ( '$nameuser', '$fullname', '$email', '$salt', '$hashedPW')";
        if ($con->query($sql) === TRUE) {
            echo "<script>alert('exito')</script>";
        } else {
          echo "<script>alert('fallo al insertar')</script>";
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        // $para      = $email;
        // $titulo    = 'WeatherPro Registro';
        // $mensaje   = 'Hola, el administrador te ha permitido entrar a la página, tus datos:';
        // $cabeceras = 'From: GalloFire' . "\r\n" .
        //     'Reply-To: webmaster@GalloFire.com';

        // mail($para, $titulo, $mensaje, $cabeceras);
        // $con->close();



      }
    }

 ?>
  <header id="cabeza" class=" w3-card-4 w3-top">  
      <li><div id="titulo">Panel</div></li>
      <ul id="barra" class="w3-black pareFondo">
        <li class="w3-teal"><a href="" title="ir a Inicio"><i class="fa fa-home w3-text-white"></i></a></li>
        <li ><a href="" title="ir atras">Atras <i class="fa fa-arrow-left"></i></a></li>
        <li ><a href="cerrarSesion.php" title="cerrar sesión"><?php echo $nombre; ?> <i class="fa fa-male"></i></a></li>
      </ul>
  </header>
  <!-- ......................FIN DEL HEADER...................... -->
  <div id="flag"></div>

  





  <!-- .....................INICIO DEL ASIDE..................... -->
  <nav class="w3-sidenav w3-collapse w3-animate-left w3-card-4 w3-padding-8" style="width:20%; background: #011d34;" id="mySidenav">  
    <p class="w3-center">
      <img src="../images/gallo.png" style="width:80%;" alt="" title="GALLO FIRE">
      <p style="text-align:justify; padding:5%;;">
       Gallo Fire es una empresa nueva especialista en soliciones climaticas. Epresa cien por ciento Colimense, que busca ser
      el lider numero uno dentro del mercado nacional. <br />
      Weather Pro es todo un sistema de monitoreo ambiental, que permite analisar las variables del clima de mejor manera.</p>
  </nav>
  <!-- .....................FIN DEL ASIDE..................... -->



  




  <section style="margin-left:20%" class="w3-main w3-container">

    <article class="w3-panel">

      <div class="w3-accordion w3-light-grey w3-card-2">
        <button id="Demo1Btn" onclick="myFunction('Demo1')" title="mostrar/ocultar" class="w3-btn-block w3-left-align rojoFondo">
          <b>
          Mediciones del dispositivo
          </b>
        </button>
        <div id="Demo1" class="w3-accordion-content">
            <div id="tiempo">
            </div>
        </div>
      </div>
      <?php 

       ?>
      <br />

      <?php 
        if ($nombre == "noeAdmin")
          include "getUsuarios.php";
         
      ?>

    <?php 
    if ($nombre != 'noeAdmin') include "darksky.php" ?>
    </article>
  </section>

<!-- .....................INICIO DEL REGISTRO..................... -->

    <div id="registroModal" class="w3-modal ">
        <div class="w3-modal-content w3-round-large">
          <h2 class="titulo w3-container w3-green w3-padding-24 ">Registrar usuario</h2>
          <div class="w3-panel">
            <form action="" method="POST">  
              <p class="w3-text-blue">Nombre completo</p>
              <input class="w3-input w3-border" type="text" name="fullname" placeholder="Noe Vazquez McQueen" oninput="checarlength(this, 35)" title="tu nombre" required>
              <p class="w3-text-blue">Nombre de usuario</p>
              <input class="w3-input w3-border" type="text" name="nameuser" placeholder="NoeMc" oninput="checarlength(this, 15)" title="para inicio de sesión" required>
              <p class="w3-text-blue">Correo</p>
              <input class="w3-input w3-border" type="text" name="email" oninput="checarEmail(this)" placeholder="noe@gmail.com" required>
              <p class="w3-text-blue">Contraseña</p>
              <input class="w3-input w3-border" type="password" id ="passwordID" placeholder="*******" required>
              <p class="w3-text-blue">Confirmar Contraseña</p>
              <input class="w3-input w3-border" type="password" name="password" oninput="checarPass(this)" placeholder="*******" required>
              <br />
              <input type="submit" name="registrar" class="w3-btn w3-blue" value="Registrar">
              <input type="button" class="w3-btn w3-red" onclick="document.getElementById('registroModal').style.display='none'" value="Cancelar">
              <br />
              <br />
            </form>
          </div>
        </div>
    </div>
  </div>
  <!-- .....................FIN DEL REGISTRO..................... -->
    <!--  -->
  <script>
    function checarPass (input) {
      if ( input.value != document.getElementById("passwordID").value ){
        input.setCustomValidity("Las contraseñas debe coincidir.");
      }else{
        input.setCustomValidity('');
      }
    }
    function checarEmail(input){
      var x = input.value;
      var arroba = x.indexOf("@");
      var punto = x.lastIndexOf(".");
      if (arroba<1 || punto<arroba+2 || punto+2>=x.length) {
        input.setCustomValidity("Correo invalido.");
      }else{
        input.setCustomValidity('');
      }
    }
    function checarlength(input, cantidad){
      if(input.value.length>cantidad){
        input.setCustomValidity("El nombre es muy largo.");
      }else{
        input.setCustomValidity('');
      }

    }
  </script>


  <script>
    function myFunction(id) {
        var x = document.getElementById(id);
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
        } else { 
            x.className = x.className.replace("w3-show", "");
        }
    }
    $('#Demo1Btn').click();
    $('#usuariosBtn').click();
</script>

<script>
      $(document).ready(function () {
          var interval = 5000;   //number of mili seconds between each call
          var refresh = function() {
              $.ajax({
                  url: "printMedUsuario.php",
                  cache: false,
                  success: function(html) {
                      $('#tiempo').html(html);
                      setTimeout(function() {
                          refresh();
                      }, interval);
                  }
              });
          };
          refresh();
      });

    </script>



  
  <div id="galloOculto" style="display:none; background: #011d34;">
    <br />
    <p class="w3-center">
      <img src="../images/gallo.png" style="width:40%; max-width:300px" alt="" title="GALLO FIRE">
      <p style="text-align:justify; padding:5%;;">
       Gallo Fire es una empresa nueva especialista en soliciones climaticas. Epresa cien por ciento Colimense, que busca ser
      el lider numero uno dentro del mercado nacional. <br />
      Weather Pro es todo un sistema de monitoreo ambiental, que permite analisar las variables del clima de mejor manera.</p>
  </div>



  <script>
    function flag(){
      if ($('#mySidenav').css('display') == 'none'){
         document.getElementById("galloOculto").style.display = "block";
      }else{
        document.getElementById("galloOculto").style.display = "none";
      }
      $('#flag').height($('#cabeza').css( "height" ));
    }
    flag();

    function w3_open() {
      document.getElementById("mySidenav").style.display = "block";
    }
    function w3_close() {
        document.getElementById("mySidenav").style.display = "none";
    }
  </script>
</body>
</html>
