<?php 
	    #OBTENER MEDICIONES
    // @$con = new mysqli("localhost","root","","weatherstation");
    $con = new mysqli("mysql.hostinger.mx","u437869613_noe","/*gallo*/","u437869613_pi");
    // @$con = new mysqli("187.204.24.98","root","raspberry","weatherStation");
    $registro = $mediciones= ['hum'=>'0', 'temp'=>'0',
                        'lum'=>'0', 'rain'=>'0',
                        'pres'=>'0'];
    $msg = null;
    if ($con->connect_error) {
      echo "<script>alert('No hay conexion a base de datos')</script>";
      $msg = "AL PARECER NO HAY CONEXIÓN A LA BASE DE DATOS";
    }
    else
    {
      $query =  "SELECT * FROM clima ORDER BY ID DESC";#"SELECT TOP 1 * FROM clima ORDER BY ID DESC";
      $result = mysqli_query($con, $query);
      $registro = mysqli_fetch_row($result);
      // var_dump($mediciones);
      mysqli_free_result($result);
      mysqli_close($con);
	  $mediciones = ['hum'=>trim($registro[2]), 'temp'=>trim($registro[3]),
	                 'lum'=>trim($registro[4]), 'rain'=>trim($registro[5]),
	                 'pres'=>trim($registro[6]) ];
    }
 ?>