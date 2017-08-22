      <div class="w3-accordion w3-light-grey w3-card-2">
        <button id="usuariosBtn" onclick="myFunction('usuarios')" title="mostrar/ocultar" class="w3-btn-block w3-left-align rojoFondo">
          <b>
          Usuarios
          </b>
        </button>

        <div id="usuarios" class="w3-accordion-content">
            
            <div class="w3-panel">
              <div >
        	<button onclick="document.getElementById('registroModal').style.display='block'" class="w3-btn w3-green w3-round">Registrar usuario</button>
                <div class="w3-responsive">
<?php 
// $conUser = new mysqli("localhost","root","","practica");
$conUser = new mysqli("mysql.hostinger.mx","u437869613_noe","/*gallo*/","u437869613_pi");
		if ($conUser->connect_error) {
			echo "<script>alert('No hay conexion a base de datos')</script>";
    		// die("Connection failed: " . $conUser->connect_error); 
		}
		else
		{
			if (isset($_GET['id'])){
					$res = mysqli_query( $conUser, "DELETE FROM users WHERE user_id = '".$_GET['id']."'");
				}
			#$queryUser =  "SELECT * FROM users";#"SELECT TOP 1 * FROM clima ORDER BY ID DESC";
			$queryUser =  "SELECT COUNT(*) FROM users";
			$resultUser = mysqli_query($conUser, $queryUser);
			$rowUser = mysqli_fetch_row($resultUser);
			$numRows = (int)$rowUser[0];
			$usuariosDiv = "";

			$queryUser =  "SELECT user_id, nameuser, fullname, email FROM users";
			$vuelto = mysqli_query($conUser, $queryUser);


			$usuario = mysqli_fetch_row($vuelto);
			for ($i=0; $i<$numRows; $i++){	
				// var_dump($usuario);
				$usuariosDiv .=
				"<div class='w3-round w3-white w3-panel w3-padding-8' style='display:inline-block; margin:5px'>
							<span class='w3-tag w3-gray'>Nombre completo: </span>'$usuario[2]' <br />
							<span class='w3-tag w3-gray'>Nombre de usuario: </span>'$usuario[1]' <br />
							<span class='w3-tag w3-gray'>Email </span> '$usuario[3]' <br /> <br /> ";
				$usuariosDiv .= ($usuario[1]!='noeAdmin')?("<a class='w3-btn w3-red w3-round' onclick= 'return confirm(". '"Borrar?"' .");' href=?id=" . $usuario[0] . ">Dar de baja</a>"):'';
				$usuariosDiv .= "</div>";
				$usuario = mysqli_fetch_row($vuelto);
			}

			#reset id:
			echo $usuariosDiv;
			
			mysqli_free_result($resultUser);
			mysqli_close($conUser);
		}
 ?>
                 </div>
              </div>
            </div>

        </div>
      </div>