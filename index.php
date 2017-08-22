<!DOCTYPE html>
<html lang="en">
<head>
  <title>Weather Pro</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
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
    margin-top: 10px;
    margin-left: 30px;
    /*background: red;*/
  }
  header button{
    color: white;
    margin-top: 30px;
    margin-right: 20px;
  }
  </style>
</head>
<body onresize="flag()">

<?php 
  session_start();

  #login:::::::::::::::::::::::::::
  if(isset($_POST['usuario']))
    {
      $con = new mysqli("mysql.hostinger.mx","u437869613_noe","/*gallo*/","u437869613_pi");
      if ($con->connect_error) {
        echo "<script>alert('No hay login disponible')</script>";
          // die("Connection failed: " . $con->connect_error); 
      }
      else
      {
        $nombre = mysqli_real_escape_string($con,$_POST['usuario']);
        $pass = mysqli_real_escape_string($con,$_POST['pass']);
        $query = "SELECT * FROM users WHERE nameuser = '$nombre';";
        $resultSet = mysqli_query($con, $query);
        if(mysqli_num_rows($resultSet) > 0){
          $saltQuery = "SELECT salt FROM users WHERE nameuser = '$nombre'";
          $result = mysqli_query($con, $saltQuery);
          $row = mysqli_fetch_assoc($result);
          $salt = $row['salt'];
          $saltedPW = $pass . $salt;
          $hashedPW = hash('sha256', $saltedPW);
          $query = "SELECT * FROM users WHERE nameuser = '$nombre' and password = '$hashedPW'";
          $resultSet = mysqli_query($con, $query);
          if(mysqli_num_rows($resultSet) > 0){
            
            $_SESSION['nombre'] = $nombre;
          }
          else
          {
          }
        }
          echo "<script>alert('usuario y/o contraseña invalido')</script>";
        mysqli_close($con);
      }
    }


  #CONTROLAR SI YA ESTA INICIADA LA SESIÓN_______________________
    $nombre = isset($_SESSION['nombre'])? $_SESSION['nombre']: null;
    if($nombre!=null){
        header("location: usuario");
    }
    #OBTENER MEDICIONES
    include "getMediciones.php"

   ?>

  <!-- ......................INICIO DEL HEADER...................... -->
  <header id="cabeza" class=" w3-card-2 w3-top">  
    <br />
    <span id="titulo" clheightass="w3-left">Wheater Pro</span>
    <button  class="w3-green w3-btn w3-right" href="" onclick="document.getElementById('id01').style.display='block'">Iniciar Sesión</button>
  </header>
  <!-- ......................FIN DEL HEADER...................... -->


  <div id="flag"></div>


  <!-- .....................INICIO DEL ASIDE..................... -->
  <nav class="w3-sidenav w3-collapse w3-animate-left w3-card-2 w3-padding-8" style="width:20%; background: #011d34;" id="mySidenav">  
    <p class="w3-center">
      <img src="images/gallo.png" style="width:80%;" alt="" title="GALLO FIRE">
      <p style="text-align:justify; padding:5%;;">
       Gallo Fire es una empresa nueva especialista en soliciones climaticas. Epresa cien por ciento Colimense, que busca ser
      el lider numero uno dentro del mercado nacional. <br />
      Weather Pro es todo un sistema de monitoreo ambiental, que permite analisar las variables del clima de mejor manera.</p>
    </p>
  </nav>
  <!-- .....................FIN DEL ASIDE..................... -->





  <!-- .....................INICIO DEL SECTION..................... -->
  <section style="margin-left:20%" class="w3-main w3-container">
    <?php if ( isset($msg) ){echo '<p>'. $msg .'</p>';}else echo''; ?>
    <article class="w3-panel">
      <h2>Mediciones metereologicas </h2>
      <div class="w3-row">

        <div>
          <p style="font-size:8rem; margin:0; text-align:center;" class="rojoLetra">
          <?php echo $mediciones['temp']; ?>
            °C</p>
          <div class="rojoFondo" style="font-size:2rem; padding-left:1rem;">Temperatura</div>
        </div>

        <div class="w3-row">

          <div class="w3-col s12 m6 l3 w3-panel">
            <p style="font-size:3rem; margin:0; text-align:center;" class="grisFondo humText">
              <?php echo $mediciones['hum'] ?>%</p>
            <div class="panel humFondo" style="font-size:1rem; padding-left:1rem;"><b>Humedad</b></div> 
          </div>
          <div class="w3-col s12 m6 l3 w3-panel">
            <p style="font-size:3rem; margin:0; text-align:center;" class="grisFondo lluvText">
              <?php echo $mediciones['rain'] ?>%</p>
            <div class="panel lluvFondo" style="font-size:1rem; padding-left:1rem;"><b>Lluvia</b></div> 
          </div>
          <div class="w3-col s12 m6 l3 w3-panel">
            <p style="font-size:3rem; margin:0; text-align:center;" class="grisFondo lumText">
              <?php echo $mediciones['lum'] ?>lms</p>
            <div class="panel lumFondo" style="font-size:1rem; padding-left:1rem;"><b>Luminosidad</b></div> 
          </div>
          <div class="w3-quartear w3-col s12 m6 l3 w3-panel">
            <p style="font-size:3rem; margin:0; text-align:center;" class="grisFondo preText">
              <?php echo $mediciones['pres'] ?>ps</p>
            <div class="panel preFondo" style="font-size:1rem; padding-left:1rem;"><b>Presion</b></div> 
          </div>
        
        </div>
      </div>
    </article>
  </section>
  <!-- .....................FIN DEL SECTION..................... -->





  <!-- .....................INICIO DEL GALLO OCULTO..................... -->  
  <div id="galloOculto" style="display:none; background: #011d34;">
    <br />
    <p class="w3-center">
      <img src="images/gallo.png" style="width:40%; max-width:300px"  title="GALLO FIRE">
      <p style="text-align:justify; padding:5%;">
       Gallo Fire es una empresa nueva especialista en soliciones climaticas. Epresa cien por ciento Colimense, que busca ser
      el lider numero uno dentro del mercado nacional. <br />
      Weather Pro es todo un sistema de monitoreo ambiental, que permite analisar las variables del clima de mejor manera.</p>
    </p>
  </div>
  <!-- .....................FIN DEL GALLO OCULTO..................... -->  





  <!-- .....................INICIO DEL MODAL REGISTRO..................... -->
  <div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-card-8 w3-animate-zoom" style="max-width:600px">

      <div class="w3-center"><br>
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-closebtn w3-hover-red w3-container w3-padding-8 w3-display-topright" title="cerrar">&times;</span>
        <h3>Iniciar Sesión</h3>
      </div>

      <form class="w3-container" name="form" action="" method="POST">
        <div class="w3-section">
          <label><b>Nombre de Usuario</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="AnaMaria23" name="usuario" required>
          <label><b>Contraseña</b></label>
          <input class="w3-input w3-border" type="password" placeholder="**********" name="pass" required>
          <input class="w3-btn-block w3-green w3-section w3-padding" type="submit" id="ingresar" name="entrar" value="Ingresar">
        </div>
      </form>
      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-btn w3-red">Cancelar</button>
        <span class="w3-right w3-padding w3-hide-small">Olvido su <a href="#">contraseña?</a></span>
      </div>

    </div>
  </div>
</div>
<!-- .....................FIN DEL MODAL REGISTRO..................... -->


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
