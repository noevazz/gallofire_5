<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sensor</title>
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
    $nombre = isset($_SESSION['nombre'])?$_SESSION['nombre']:null;
    if(!isset($nombre) )
    {
      header("Location: ../");
    }

 ?>
<?php
    $sensor = isset($_GET['s'])?$_GET['s']:null;
    // echo "<script>alert(" . $sensor . ")</script>";
    $getValido = false;
    $mediciones = ['hum', 'temp', 'lum', 'rain', 'pres'];
    foreach ($mediciones as $key) {
      if ($key==$sensor){
        $getValido = true;
      }
    }
 ?>
  <header id="cabeza" class="w3-card-4 w3-top">  
    <li><div id="titulo">Sensores</div></li>
    <ul id="barra" class="w3-black">
      <li class="w3-teal"><a href="../" title="ir a Inicio"><i class="fa fa-home w3-text-white"></i></a></li>
      <li ><a href="../" title="ir atras">Atras <i class="fa fa-arrow-left"></i></a></li>
      <li ><a href="../cerrarSesion.php" title="cerrar sesión"><?php echo $nombre; ?> <i class="fa fa-male"></i></a></li>
    </ul>
  </header>
  <!-- ......................FIN DEL HEADER...................... -->
  
  <div id="flag"></div>







  <!-- .....................INICIO DEL ASIDE..................... -->
  <nav class="w3-sidenav w3-collapse w3-animate-left w3-card-4 w3-padding-8" style="width:20%; background: #011d34;" id="mySidenav">  
    <p class="w3-center">
      <img src="../../images/gallo.png" style="width:80%;" alt="" title="GALLO FIRE">
      <p style="text-align:justify; padding:5%;;">
       Gallo Fire es una empresa nueva especialista en soliciones climaticas. Epresa cien por ciento Colimense, que busca ser
      el lider numero uno dentro del mercado nacional. <br />
      Weather Pro es todo un sistema de monitoreo ambiental, que permite analisar las variables del clima de mejor manera.</p>
    </p>
  </nav>
  <!-- .....................FIN DEL ASIDE..................... -->




  <section style="margin-left:20%" class="w3-main w3-container">
    <article class="w3-panel">
        <h2 id="Demo1Btn" class="ww3-left-align rojoFondo">
          
          Detalles de sensor
        </h2>
        <?php if ($getValido) include "chart.php"; else include"default.php"; ?>

    </article>
  </section>
  



  
  <div id="galloOculto" style="display:none; background: #011d34;">
    <br />
    <p class="w3-center">
      <img src="../../images/gallo.png" style="width:40%; max-width:300px" alt="" title="GALLO FIRE">
      <p style="text-align:justify; padding:5%;;">
       Gallo Fire es una empresa nueva especialista en soliciones climaticas. Epresa cien por ciento Colimense, que busca ser
      el lider numero uno dentro del mercado nacional. <br />
      Weather Pro es todo un sistema de monitoreo ambiental, que permite analisar las variables del clima de mejor manera.</p>
    </p>
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
  </script>
  <script src="canvasjs.min.js"></script>
</body>
</html>
