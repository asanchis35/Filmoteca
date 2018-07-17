<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Inicio</title>
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

	
	$query = "select titulo from pelicula";
	
	
	$consulta = mysqli_query($db,$query);
	
	
	
	
	
	$i=0;
	global $name;
	
	
	while($resultados = mysqli_fetch_array($consulta)) { 

		
        
		$titulo = $resultados['titulo'];
		
		
		
		
		$name[$i]=$titulo;
		$i=$i+1;		
		
		
		
    } 
	
	
	$db= null;
}

function consul()
{
	$db=conectaDb();
	print "<br> Conexion Realizada<br>";
	
	
	
	
	
	global $idpelicula;
	global $anyi;
	
	$query = "SELECT id, anyo FROM pelicula WHERE titulo = ".'"'. $_POST["lista-final"].'"';
		//echo "<br>";
		//echo $query;
	
		//Se envia la Query a la Base de datos
		$consulta = mysqli_query($db,$query);


		while($resultados = mysqli_fetch_array($consulta)) { 

			$idpelicula = $resultados['id']; 
			$anyi = $resultados['anyo'];
			//echo $idpelicula;
			//echo $anyi;

		}	
	

	global $support;
	global $support2;
	global $suma;
	$query = "select s.id, s.descripcion, s.nombre, p.id from pelicula p, soporte_x_pelicula sp, soporte s where s.id=sp.idsoporte and sp.idpelicula=p.id and p.titulo=".'"'. $_POST["lista-final"].'"';
		//echo "<br>";
		//echo $query;
	
		//Se envia la Query a la Base de datos
		$consulta = mysqli_query($db,$query);


		while($resultados = mysqli_fetch_array($consulta)) { 

			$idpelicula = $resultados['id']; 
			$support = $resultados['nombre'];
			$support2 = $resultados['descripcion'];
			$suma = $resultados['nombre']. " - " .$resultados['descripcion'];
			//echo $idpelicula;
			//echo $support;
			//echo $suma;

		}
		
	global $gene;
	$query = "select g.id, g.descripcion, p.id from pelicula p, genero g where g.id=p.idgenero and p.titulo=".'"'. $_POST["lista-final"].'"';
		//echo "<br>";
		//echo $query;
	
		//Se envia la Query a la Base de datos
		$consulta = mysqli_query($db,$query);


		while($resultados = mysqli_fetch_array($consulta)) { 

			$idpelicula = $resultados['id']; 
			$gene = $resultados['descripcion'];
			//echo $idpelicula;
			//echo $gene;

		}	
		
	global $total;
	//concat(d.nombre,' ',d.apellidos)
	$query = "select d.nombre, d.apellidos from director d, pelicula p where d.id=p.iddirector and p.titulo=".'"'. $_POST["lista-final"].'"';
		//echo "<br>";
		//echo $query;
	
		//Se envia la Query a la Base de datos
		$consulta = mysqli_query($db,$query);


		while($resultados = mysqli_fetch_array($consulta)) { 

			//$idpelicula = $resultados['p.id'];
			
			$nombre = $resultados['nombre']; 
			$apellidos = $resultados['apellidos'];
			
			$total = $resultados['nombre']. " " .$resultados['apellidos'];
			
			//echo $total;

		}	
		
		global $fot;
		
		$query = "SELECT id, foto FROM pelicula WHERE titulo = ".'"'. $_POST["lista-final"].'"';
		//echo "<br>";
		//echo $query;
	
		//Se envia la Query a la Base de datos
		$consulta = mysqli_query($db,$query);


		while($resultados = mysqli_fetch_array($consulta)) { 

			$idpelicula = $resultados['id']; 
			$fot = $resultados['foto'];
			//echo "<img src=$fot><br>";
			//echo $fot;

		}	
		
		global $act;
		
		$query = "select a.nombre, a.apellidos from pelicula p, actor_x_pelicula ap, actor a where a.id=ap.idactor and ap.idpelicula = p.id and p.titulo=".'"'. $_POST["lista-final"].'"';
		
		//echo "<br>";
		//echo $query;
	
		//Se envia la Query a la Base de datos
		$consulta = mysqli_query($db,$query);


		while($resultados = mysqli_fetch_array($consulta)) { 

			//$idpelicula = $resultados['p.id'];
			
			$nombre = $resultados['nombre']; 
			$apellidos = $resultados['apellidos'];
			
			$act = $resultados['nombre']. " " .$resultados['apellidos'];
			
			//echo $act;

		}	
		
}


if (isset($_POST['consul'])) 
{
	consul();
} 


leer_datos();

?>



	
  <div class="container-fluid">

		<div class="jumbotron container">
		
			<div class="row align-items-end">

				<div class="col-3">
					<ul class="nav flex-column mb-5">
						<li class="nav-item">
							<a class="nav-link active" href="#">Inicio</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="/usb-final/peliculas.php">Nueva pelicula</a>
						</li>
						<li class="nav-item">
							<a class="nav-link active" href="/usb-final/actores.php">Actor</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="/usb-final/directores.php">Director</a>
						</li>
					</ul>
				</div>
		
				<div class="col-9">
					<div class="row">
						<div class="col-6">
							<h1 class="display-4 text-center mb-5">FICHA</h1>

							<legend>Género:
								<?php
							
									echo $gene;
									
								?>
							</legend>

							<legend>Año: 
								<?php
									
									echo $anyi;
									
								?>
							</legend>

							<legend>Soporte: 
								<?php
									
									echo $suma;
									
								?>
							</legend>

							<div class="alert alert-light">
								<legend>ACTORES</legend>

								<?php
									
									echo $act;
									
								?>
							</div>

							<div class="alert alert-light">
								<legend>DIRECTOR</legend>

									<?php
							
										echo $total;
							
									?>
							</div>
						</div>

						<div class="col-6">
							<form action="" method="post">
								<div style="background: url('<?php echo $fot ?>') no-repeat center; max-width: 400px; height: 300px"></div>
							</form>
							
							<form action="" method="post">
								<div class="form-group">
									<select id="lista-final" name="lista-final" size="5" multiple="multiple" class="form-control">
							
										<?php
											foreach ($name as $valor)
											{
												echo '<option value="'.$valor.'">';
												echo $valor;
												echo '</option>';
											}
											
										?>
				
									</select>
								</div>
								<div class="form-group">
									<button name="consul" type="submit" value="Enviar Datos" class="btn btn-success btn-lg">Consulta</button>
								</div>
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