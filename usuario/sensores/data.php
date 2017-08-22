<?php

header('Content-Type: application/json');
// $con = mysqli_connect("127.0.0.1","user","password","canvasjssampledb");
$con = new mysqli("mysql.hostinger.mx","u437869613_noe","/*gallo*/","u437869613_pi");

// Check connection
if (mysqli_connect_errno($con))
{
    echo "Failed to connect to DataBase: " . mysqli_connect_error();
}else
{
    $data_points = array();
    
    $result = mysqli_query($con, "SELECT * FROM clima ORDER BY ID DESC LIMIT 10";);
    
    while($row = mysqli_fetch_array($result))
    {        
        $point = array("label" => $row['date'] , "y" => $row['total_sales']);
        
        array_push($data_points, $point);        
    }
    
    echo json_encode($data_points, JSON_NUMERIC_CHECK);
}
mysqli_close($con);

?>