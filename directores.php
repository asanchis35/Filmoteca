<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Directores</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>


<?php




function conectaDb()
{
	
	$con = mysqli_connect("localhost","root",""); 
	
	
    if (!$con) 
    { 
		echo 'Could not connect: ' . mysqli_error(); 
		exit();
    } 
	
	
    mysqli_select_db($con,"filmoteca");
	
	
	return $con;
}
			


function escribir_registro()
{
	
	$db=conectaDb();
	print "<br> Conexion Realizada<br>";	
	
	$nombre = '"'.$_POST["nombre"].'"';
	
	$apellidos = '"'.$_POST["apellidos"].'"';
	
	$query = "INSERT INTO director (nombre, apellidos) VALUES($nombre,$apellidos)";
	
	

	$consulta = mysqli_query($db,$query);
	
	
	$db=null;
}


function leer_datos()
{
	
	$db=conectaDb();
	print "<br> Conexion Realizada<br>";

	
	$query = "select apellidos,nombre,imdb from director";
	
	
	$consulta = mysqli_query($db,$query);
	
	
	
	$i=0;
	global $nomap;
	while($resultados = mysqli_fetch_array($consulta)) { 

		
        $apellidos = $resultados['apellidos']; 
		$nombre = $resultados['nombre'];
		$total = $resultados['nombre']. " " .$resultados['apellidos'];
		
		
		
		$nomap[$i]=$total;
		$i=$i+1;
    } 
	
	
	$db= null;
}


function informacion()
{
	$db=conectaDb();
	
	global $imdb;
		
		$query = "SELECT imdb FROM director WHERE concat (nombre,' ',apellidos) = ".'"'. $_POST["lista-director"].'"';
		//echo "<br>";
		//echo $query;
	
		//Se envia la Query a la Base de datos
		$consulta = mysqli_query($db,$query);


		while($resultados = mysqli_fetch_array($consulta)) { 

			//$idpelicula = $resultados['id']; 
			$imdb = $resultados['imdb'];
			//echo "<img src=$fot><br>";
			//echo $fot;

		}	
	
	
	
}


//Funcion Borrar Registro
function borrar_registro()
{
	//Conexion con Base de Datos
	$db=conectaDb();
	print "<br> Conexion Realizada<br>";

	//echo $_POST["lista-director"];
	
	//Se monta la Query para borrar el registro
	//$registro = $_POST["registro"];
	$query = "DELETE FROM director WHERE concat (nombre,' ',apellidos) = ". '"'. $_POST["lista-director"].'"';
	//echo $query; 
	
	//Se envia la Query a la Base de datos
	$consulta = mysqli_query($db,$query);
	
	//Se comprueba que el borrado se ha realizado correctamente.
	if (!$consulta) {
	print "<br> Fallo al Realizar el borrado<br>";
	} else {
	print "<br> Registro borrado correctamente<br>";
	}
	
	//desconexion de la base de datos
	$db= null;
}


//------------------- CUERPO PRINCIPAL --------------------

if (isset($_POST['escribir_registro'])) 
{
	escribir_registro();
} 

leer_datos();

if (isset($_POST['borrar_registro'])) 
{
	borrar_registro();
} 




?>



	
    <div class="container-fluid">

			<div class="jumbotron container">
				<h1 class="display-4 text-center mb-5">DIRECTORES</h1>
				<div class="row align-items-end">

					<div class="col-3">
						<ul class="nav flex-column mb-5">
							<li class="nav-item">
								<a class="nav-link" href="/usb-final/inicio.php">Inicio</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="/usb-final/peliculas.php">Nueva pelicula</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">Actor</a>
							</li>
							<li class="nav-item">
								<a class="nav-link active" href="/usb-final/directores.php">Director</a>
							</li>
						</ul>
					</div>

					<div class="col-9">
						<div class="row">
							
							<div class="col-6">
								<form action="" method="post">
									<div class="form-group">
										<label>Nombre:</label>
										<input class="form-control" type="text" name="nombre" value="">
									</div>

									<div class="form-group mb-5">					
										<label>Apellidos:</label>
										<input class="form-control" type="text" name="apellidos" value="">
									</div>

									<div class="alert alert-light mb-5">
										<label>IMDB</label>
										<!-- <input type="text" name="imdb" value="">-->
										<?php
										if (isset($_POST['informacion'])) 
										{
										informacion();
										echo $imdb;
										}
										?>
									</div>

									<div class="form-group mt-5">
										<button name="escribir_registro" type="submit" value="Enviar Datos" class="btn btn-success btn-lg mr-5 mt-2">Añadir</button>
										<button type="reset" class="btn btn-danger btn-lg mt-2">Reset</button>
									</div>
								</form>
							</div>

							<div class="col-6">
								<form action="" method="post">
									<div class="form-group">
										<select id="lista-director" name="lista-director" size="10" multiple="multiple" class="form-control">
														
											<?php
											foreach ($nomap as $valor)
											{
												echo '<option value="'.$valor.'">';
												echo $valor;
												echo '</option>';
											}
											
											?>							
										
										</select>
									</div>

									<div class="form-group">
										<button name="borrar_registro" type="submit" class="btn btn-danger btn-lg mr-5 mt-2">Borrar</button>
										<button name="informacion" type="submit" class="btn btn-info btn-lg mt-2">+info</button>
									</div>
						
									</form>

							</form>

						</div><!-- col-6 -->
					</div><!-- row -->
				</div><!-- col-9 -->
			</div><!-- row -->

			<footer class="footer">
			FILMOTECA 2018 ©
			</footer>

		</div><!-- jumbotron -->
	</div><!-- container -->
	</body>
</html>  