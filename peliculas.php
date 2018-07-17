<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Películas</title>
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



function leer_datos2()
{
	
	$db=conectaDb();
	print "<br> Conexion Realizada<br>";

	
	$query = "select apellidos,nombre,imdb from actor";
	
	
	$consulta = mysqli_query($db,$query);
	
	
	
	$ii=0;
	global $nomap2;
	while($resultados = mysqli_fetch_array($consulta)) { 

		
		$apellidos = $resultados['apellidos']; 
		$nombre = $resultados['nombre'];
		$total = $resultados['nombre']. " " .$resultados['apellidos'];
		
		
		
		$nomap2[$ii]=$total;
		$ii=$ii+1;
    } 
	
	
	$db= null;
}			



	
	
function escribir_registro()
{
		global $idactor;
		global $idpelicula;
		global $iddirector;
		global $idsoporte;
		global $idgenero;
	
		
	
	$db=conectaDb();
	print "<br> Conexion Realizada<br>";	
	
	$titulo = '"'.$_POST["titulo"].'"';
	
	$genero = '"'.$_POST["genero"].'"';
	
	$anyo = '"'.$_POST["anyo"].'"';
	
	$foto = '"'.$_POST["foto"].'"';
	
	$soporte = '"'.$_POST["soporte"].'"';
	
	
	//soporte
	if ($_POST['soporte']=='DVD')
	{
		$soporte=1;
	}
	if ($_POST['soporte']=='BR')
	{
		$soporte=2;
	}
	if ($_POST['soporte']=='VHS')
	{
		$soporte=3;
	}
	if ($_POST['soporte']=='BR-4k')
	{
		$soporte=4;
	}
	
	//genero
	if ($_POST['genero']=='Aventuras')
	{
		$genero=1;
	}
	if ($_POST['genero']=='Ciencia-ficción')
	{
		$genero=2;
	}
	if ($_POST['genero']=='Western')
	{
		$genero=3;
	}
	if ($_POST['genero']=='Drama')
	{
		$genero=4;
	}
	if ($_POST['genero']=='Accion')
	{
		$genero=5;
	}
	if ($_POST['genero']=='Comedia')
	{
		$genero=6;
	}
	
	
	
	
	$query = "SELECT ID FROM DIRECTOR WHERE concat (nombre,' ',apellidos) = ". '"'. $_POST["lista-director"].'"';
		//echo "<br>";
		//echo $query;
	
		//Se envia la Query a la Base de datos
		$consulta = mysqli_query($db,$query);


		while($resultados = mysqli_fetch_array($consulta)) { 

			$iddirector = $resultados['ID']; 
			//echo $iddirector;

		} 
	
	
	$query = "SELECT ID FROM genero WHERE descripcion= ". '"'. $_POST["genero"].'"';
		//echo "<br>";
		//echo $query;
	
		//Se envia la Query a la Base de datos
		$consulta = mysqli_query($db,$query);
		
		while($resultados = mysqli_fetch_array($consulta)) { 

			$idgenero = $resultados['ID']; 
			//echo $idgenero;

		} 
		
	$query = "INSERT INTO pelicula (titulo, anyo, foto, idgenero, iddirector) VALUES($titulo, $anyo, $foto, $idgenero, $iddirector)";
	
	$consulta = mysqli_query($db,$query);
	
	
	
	$query = "SELECT ID FROM pelicula WHERE titulo= ". '"'. $_POST["titulo"].'"';
		//echo "<br>";
		//echo $query;
	
		//Se envia la Query a la Base de datos
		$consulta = mysqli_query($db,$query);
		
		while($resultados = mysqli_fetch_array($consulta)) { 

			$idpelicula = $resultados['ID']; 
			//echo $idpelicula;

		} 
	
	$query = "SELECT ID FROM soporte WHERE nombre= ". '"'. $_POST["soporte"].'"';
		//echo "<br>";
		//echo $query;
	
		//Se envia la Query a la Base de datos
		$consulta = mysqli_query($db,$query);
		
		while($resultados = mysqli_fetch_array($consulta)) { 

			$idsoporte = $resultados['ID']; 
			//echo $idsoporte;

		} 
	
		
	
	$query = "INSERT INTO soporte_x_pelicula( idsoporte, idpelicula) VALUES ($idsoporte, $idpelicula)";
	
	$consulta = mysqli_query($db,$query);

	
	$query = "SELECT ID FROM actor WHERE concat (nombre,' ',apellidos) = ". '"'. $_POST["lista-actor"].'"';
		//echo "<br>";
		//echo $query;
	
		//Se envia la Query a la Base de datos
		$consulta = mysqli_query($db,$query);


		while($resultados = mysqli_fetch_array($consulta)) { 

			$idactor = $resultados['ID']; 
			//echo $idactor;

		}
	
	
	$query = "INSERT INTO actor_x_pelicula (idpelicula, idactor) VALUES($idpelicula, $idactor)";
	
	$consulta = mysqli_query($db,$query);
	
	
	$db=null;
}





//------------------- CUERPO PRINCIPAL --------------------

if (isset($_POST['escribir_registro'])) 
{
		
					
		$db=conectaDb();
		
		
		
		

		$query = "SELECT ID FROM DIRECTOR WHERE concat (nombre,' ',apellidos) = ". '"'. $_POST["lista-director"].'"';
		//echo "<br>";
		//echo $query;
	
		//Se envia la Query a la Base de datos
		$consulta = mysqli_query($db,$query);


		while($resultados = mysqli_fetch_array($consulta)) { 

			$iddirector = $resultados['ID']; 
			//echo $iddirector;

		} 
	
	
		$query = "SELECT ID FROM actor WHERE concat (nombre,' ',apellidos) = ". '"'. $_POST["lista-actor"].'"';
		//echo "<br>";
		//echo $query;
	
		//Se envia la Query a la Base de datos
		$consulta = mysqli_query($db,$query);


		while($resultados = mysqli_fetch_array($consulta)) { 

			$idactor = $resultados['ID']; 
			//echo $idactor;

		}
		
		$query = "SELECT ID FROM soporte WHERE nombre= ". '"'. $_POST["soporte"].'"';
		//echo "<br>";
		//echo $query;
	
		//Se envia la Query a la Base de datos
		$consulta = mysqli_query($db,$query);
		
		while($resultados = mysqli_fetch_array($consulta)) { 

			$idsoporte = $resultados['ID']; 
			//echo $idsoporte;

		} 
		
		$query = "SELECT ID FROM genero WHERE descripcion= ". '"'. $_POST["genero"].'"';
		//echo "<br>";
		//echo $query;
	
		//Se envia la Query a la Base de datos
		$consulta = mysqli_query($db,$query);
		
		while($resultados = mysqli_fetch_array($consulta)) { 

			$idgenero = $resultados['ID']; 
			//echo $idgenero;

		} 

			
		
		
		
		$query = "SELECT ID FROM pelicula WHERE titulo= ". '"'. $_POST["titulo"].'"';
		//echo "<br>";
		//echo $query;
	
		//Se envia la Query a la Base de datos
		$consulta = mysqli_query($db,$query);
		
		while($resultados = mysqli_fetch_array($consulta)) { 

			$idpelicula = $resultados['ID']; 
			//echo $idpelicula;

		} 
			
	escribir_registro();
		
	
	
	
	//desconexion de la base de datos
	$db= null;		
	
								
	
} 

leer_datos();
leer_datos2();


//borrar_registro();
	

?>
			
	<div class="container-fluid">

		<div class="jumbotron container">
			<h1 class="display-4 text-center mb-5">PELÍCULAS</h1>
				<div class="row align-items-end">
					

					<div class="col-3">
						<ul class="nav flex-column mb-5">
							<li class="nav-item">
								<a class="nav-link" href="/usb-final/inicio.php">Inicio</a>
							</li>
							<li class="nav-item">
								<a class="nav-link active" href="#">Nueva pelicula</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="/usb-final/actores.php">Actor</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="/usb-final/directores.php">Director</a>
							</li>
						</ul>
					</div>

					<div class="col-9">
						

						<div class="row">

							<div class="col-6">
								<form action="" method = "post">
									<div class="form-group">
										<label>Título:</label>
										<input class="form-control" type="text" name="titulo" value="">
									</div>

									<div class="form-group mb-5">
										<label>Año:</label>
										<input class="form-control" type="text" name="anyo" value="">
									</div>	

									<div class="row">
										<div class="col-6">
											<div class="form-group mb-5">
												<legend>Género:</legend>

												<input class="form-check-label" type="radio" name="genero" value="Aventuras"> Aventuras <br>
												<input class="form-check-label" type="radio" name="genero" value="Ciencia-Ficcion"> Ciencia-Ficción <br>
												<input class="form-check-label" type="radio" name="genero" value="Western"> Western <br>
												<input class="form-check-label" type="radio" name="genero" value="Drama"> Drama <br>
												<input class="form-check-label" type="radio" name="genero" value="Accion"> Accion <br>
												<input class="form-check-label" type="radio" name="genero" value="Comedia"> Comedia <br>
												
											</div>
										</div>
										<div class="col-6">
											<div class="form-group mb-5">
												<legend>Soporte:</legend>

												<input class="form-check-label" type="checkbox" name="soporte" value="DVD"> DVD <br>
												<input class="form-check-label" type="checkbox" name="soporte" value="BR"> BR <br>
												<input class="form-check-label" type="checkbox" name="soporte" value="VHS"> VHS <br>
												<input class="form-check-label" type="checkbox" name="soporte" value="BR-4K"> BR-4K <br>
											
											</div>
										</div>
									</div>


									<div class="form-group">
										<input class="form-control-file" type="file" name='foto' value=''>
									</div>

									<div class="form-group mt-5">
										<button name="escribir_registro" type="submit" value="Enviar Datos" class="btn btn-success btn-lg mr-5 mt-2">Añadir</button>
										<button type="reset" class="btn btn-danger btn-lg mt-2">Reset</button>
									</div>
								</div>

								<div class="col-6">
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
										<!-- <button type="reset" class="btn">Borrar</button>-->
									</div>

									<div class="form-group">
										<select id="lista-actor" name="lista-actor" size="10" multiple="multiple" class="form-control">
														
											<?php
											foreach ($nomap2 as $valor2)
											{
												echo '<option value="'.$valor2.'">';
												echo $valor2;
												echo '</option>';
											}
											
											?>
											
											
										</select>
										<!-- <button type="reset" class="btn">Borrar</button>-->
									</div>
								</form>
							</div>

						</div>
					</div>
				</div>
				
				<footer class="footer">
					FILMOTECA 2018 ©
				</footer>

		</div><!-- jumbotron -->
   </div><!-- container -->
	</body>
</html>  