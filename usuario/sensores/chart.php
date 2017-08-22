
<?php

    $titulo = '';
    $color = "#e74c3c";
    switch ($sensor) {
      case 'hum':
        $titulo = "humedad";
        $color = "#267eed";
        break;

      case 'temp':
        $titulo = "temperatura";
        $color = "#fb4b12";
        break;

      case 'lum':
        $titulo = "luminosidad";
        $color = "#e88c18";
        break;

      case 'rain':
        $titulo = "lluvia";
        $color = "#5048de";
        break;

      case 'pres':
        $titulo = "presión";
        $color = "#011d34";
        break;
      
      default:
        $titulo = "parece que ocurrio algo!";
        break;
    }
    // echo "<script>alert(".$sensor.")</script>";
    // $c = new mysqli("187.204.24.98","root","raspberry","weatherstation");
    $con = new mysqli("mysql.hostinger.mx","u437869613_noe","/*gallo*/","u437869613_pi");

    if ($con->connect_error) {
      echo "<script>alert('No hay conexion a base de datos')</script>";
      $titulo = "parece que ocurrio algo!";
    }
    else
    {
      // $q =  "SELECT * FROM clima ORDER BY ID DESC LIMIT 10";
      $query =  "SELECT * FROM clima ORDER BY ID DESC LIMIT 10";
      $r = mysqli_query($con, $query) or die(mysqli_error($con));
      // $ro = mysqli_fetch_all($r, MYSQLI_ASSOC);

      // $ro = array();
      // while($row=mysql_fetch_assoc($query))
      //   $ro[] = $row;
      $ro = [];
      while ($row = $r->fetch_assoc()) {
          $ro[] = $row;
      }



      mysqli_close($con);
      $grafica = '';
      $tiempo = '';
      for ($i=9; $i >= 0; $i--) { 
        $tiempo = '';
        $grafica .= '{y: ';
        
        $grafica .= (floatval($ro[$i][$sensor])? $ro[$i][$sensor]: '0' );
        $tiempo .=  ", label: '";
        $tiempo .= $ro[$i]['date'];
        $tiempo .= "'";
        $grafica .=  $tiempo ;

        $grafica .= '}';

        if($i!=0)
          $grafica .= ', ';
      }
    }
        echo "
        <script src='canvasjs.min.js'></script>
        <script>
          window.onload = function () {
            var chart = new CanvasJS.Chart('chartContainer', {
              title: {
                text: ". "'$titulo'" ."
              },
              axisY: {
                labelFontSize: 20,
                labelFontColor: 'dimGrey'
              },
              axisX: {
                title: 'hora y fecha',
                labelAngle: -30
              },
              data: [
              {
                type: 'area',
                color: '". $color ."',
                dataPoints: [".
                $grafica .
                "]
              }
              ]
            });

          chart.render();
          }
        </script>

          ".
          "<div id='chartContainer' style='height: 300px; width: 90%;''>
        </div>
        <p>La gráfica de arriba muestra los ultimos valores que se han registrado, está gráfica se
          actualiza de forma automática cada 10 segundos.</p>";
?>