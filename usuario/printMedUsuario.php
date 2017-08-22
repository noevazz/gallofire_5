<?php 
include "../getMediciones.php";
echo
"<ul class='w3-navbar w3-centered'> 
			<li style='width:20%'><a href='sensores?s=temp' title='ver detalles'>
              <div>
                <p style='font-size:2rem; margin:0;' class='grisFondo rojoLetra'>"
                  . $mediciones['temp'] . "°C</p>
                <div class='panel rojoFondo' style='font-size:1rem;'><b>Temperatura</b></div>
              </div>
   			</a></li>
            
            <li style='width:20%'><a href='sensores?s=hum' title='ver detalles'>
              <div>
                  <p style='font-size:2rem; margin:0;' class='grisFondo humText'> " 
                    . $mediciones['hum'] . "%</p>
                  <div class='panel humFondo' style='font-size:1rem;'><b>Humedad</b></div> 
              </div>
            </a></li>

            <li style='width:20%'><a href='sensores?s=rain' title='ver detalles'>
              <div>
                <p style='font-size:2rem; margin:0;' class='grisFondo lluvText'>"
                 . $mediciones['rain']. "%</p>
                <div class='panel lluvFondo' style='font-size:1rem;'><b>Lluvia</b></div> 
              </div>
            </a></li>
            
            <li style='width:20%'><a href='sensores?s=lum' title='ver detalles'>
              <div>
                <p style='font-size:2rem; margin:0;' class='grisFondo lumText'>"
                  . $mediciones['lum'] . "lms</p>
                <div class='panel lumFondo' style='font-size:1rem;'><b>Luminosidad</b></div> 
              </div>
            </a></li>

            <li style='width:20%'><a href='sensores?s=pres' title='ver detalles'>
              <div>
                <p style='font-size:2rem; margin:0;' class='grisFondo preText'> "
                 . $mediciones['pres'] . "ps</p>
                <div class='panel preFondo' style='font-size:1rem;'><b>Presion</b></div> 
              </div>  
            </a></li>
</ul>
            ";
 ?>