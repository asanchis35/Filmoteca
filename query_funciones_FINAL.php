<!-- FUNCIONES PHP PARA  LECTURA, INSERCION Y BORRADO DE DATOS -->
<html>
<head>
	<meta charset="utf-8">
    <title>Filmoteca</title>
</head>

<body style="background-color: lightgray">

<?php

//Funciones para conectar, Escribir, leer y modificar una tabla
//Mediante el uso de las funciones MYSQL
//BBDD -> bbddpersonal
//tabla-> personas
//Tabla formada por dos campos: id int(2), nombre varchar(30), primary key(id)

//Funcion para Conectar a la BD
function conectaDb()
{
	//Funcion para conectar con Base de Datos. 
	// Se pasa direccion de la base de datos, el login y el password
	$con = mysqli_connect("localhost","root",""); 
	
	//Si no hay  conexion se muestra mensaje de error y finaliza php
    if (!$con) 
    { 
		echo 'Could not connect: ' . mysqli_error(); 
		exit();
    } 
	
	//Se seleccion la base de datos.
    mysqli_select_db($con,"filmoteca");
	
	//retorna la conexion a la base de datos.
	return $con;
}
			

//Funcion Escribir Registro
function escribir_registro()
{
	//Conexion con Base de Datos
	$db=conectaDb();
	print "<br> Conexion Realizada<br>";

	//Se monta la Query para insertar el registro
	//$registro = $_POST["registro"];
	//$nombre = '"'.$_POST["nombre"].'"';
	//$id = "\"$_POST["id"]\"";
	$nombre = '"'.$_POST["nombre"].'"';
	//$apellidos = "\"$_POST["apellidos"]\"";
	$apellidos = '"'.$_POST["apellidos"].'"';
	
	$query = "INSERT INTO actor (nombre, apellidos) VALUES($nombre,$apellidos)";
	
	
	//Se envia la Query a la Base de datos
	$consulta = mysqli_query($db,$query);
	
	//Se comprueba que la insercion se ha realizado correctamente.
	//if (!$consulta) {
	//print "<br> Fallo al Realizar la insercion<br>";
	//} else {
	//print "<br> Registro introducido correctamente<br>";
	//}
	
	//desconexion de la base de datos
	$db=null;
}


//Funcion Leer Datos
function leer_datos()
{
	//Conexion con Base de Datos
	$db=conectaDb();
	print "<br> Conexion Realizada<br>";

	//Se monta la Query para consultar datos
	$query = "select concat(apellidos,", ",nombre) as actores from actor";
	
	//Con la siguiente instruccion podemos coger el literal con la contrabarra
	//$query = "SELECT * from personas where id=\"1\"";
	//Se envia la Query a la Base de datos
	$consulta = mysqli_query($db,$query);
	
	//$resultados en una matriz que contiene los datos de un registro.
	//El bucle se repite tantas veces como registros se devueven.
	while($resultados = mysqli_fetch_array($consulta)) { 

		//Se recupera la informacion del registro
		//El indice de la matriz es el nombre de la columna.
        //$id = $resultados['id']; 
        $apellidos = $resultados['apellidos']; 
		//$nombre = $resultados['nombre'];
		//$imdb = $resultados['imdb'];
		
		//Visualiza el registro
		print "<p>$apellidos</p>\n";
    } 
	
	//desconexion de la base de datos
	$db= null;
}


//Funcion Borrar Registro
//function borrar_registro()
//{
	//Conexion con Base de Datos
	//$db=conectaDb();
	//print "<br> Conexion Realizada<br>";

	//Se monta la Query para borrar el registro
	//$registro = $_POST["registro"];
	//$query = "DELETE FROM peliculas WHERE id=$nombre";
	
	//Se envia la Query a la Base de datos
	//$consulta = mysqli_query($db,$query);
	
	//Se comprueba que el borrado se ha realizado correctamente.
	//if (!$consulta) {
	//print "<br> Fallo al Realizar el borrado<br>";
	//} else {
	//print "<br> Registro borrado correctamente<br>";
	//}
	
	//desconexion de la base de datos
	//$db= null;
//}

//CODIGO RAIZ DEL PHP. DETECCION DE LOS BOTONES SUBMIT

//Se pulsa el boton submit de Escribir Registro
if (isset($_POST['escribir_registro'])) 
{
	escribir_registro();
} 

//Se pulsa el boton submit de Leer Datos
if (isset($_POST['leer_datos'])) 
{
	leer_datos();
} 

//Se pulsa el boton submit de Borrar Registro
//if (isset($_POST['borrar_registro'])) 
//{
//	borrar_registro();
//} 


?>

<br><br><a href="query_funciones_FINAL.php.html">Volver a la Pagina</a>


</body>
</html>