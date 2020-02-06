<?php 
if(!isset($_SESSION)){
	session_start();
	
}
include('conexiones/conexionLocalhost.php');
include('includes/codigoComun.php');
if(isset($_GET['valor'])){
$queryGetpeli = sprintf("SELECT id, nombrePeli, descripcion, fotoPeli, genero FROM peliculas WHERE nombrePeli LIKE '%s' AND genero like '%s' " ,
	mysql_real_escape_string(trim("%".$_GET['valor']."%")),
	mysql_real_escape_string(trim("%".$_GET['genero']."%"))

);
//Ejecutamos el query
$resQuerygetpeli = mysql_query($queryGetpeli, $conexionLocalhost) or trigger_error(mysql_error(), E_USER_ERROR);
//Hacemos un fetch para extraer el primer registro del recordset
$pelis = mysql_fetch_assoc($resQuerygetpeli);
//Realizamos un conteo de los resultados
$totalpelis = mysql_num_rows($resQuerygetpeli);
}else{
$queryGetpeli = "SELECT id, nombrePeli, descripcion, fotoPeli, genero FROM peliculas";
//Ejecutamos el query
$resQuerygetpeli = mysql_query($queryGetpeli, $conexionLocalhost) or trigger_error(mysql_error(), E_USER_ERROR);
//Hacemos un fetch para extraer el primer registro del recordset
$pelis = mysql_fetch_assoc($resQuerygetpeli);
//Realizamos un conteo de los resultados
$totalpelis = mysql_num_rows($resQuerygetpeli);

}
 ?>
<!DOCTYPE html PUBLIC>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	
	<link href="css/estiluchos.css"  rel="stylesheet" >

</head>
<body>
	<?php include('includes/nev.php'); ?>
	
	
	
	<div class="noticia">
	<form action="userBuscarpeli.php" method="get">
  	<label for="valor">Buscar:</label>
  	<input type="text" name="valor" />
  	<label form="genero">Genero:</label>
    <select id="genero" name="genero" >
          <option value="" selected ="selected">Seleciona genero</option>
          <option value="accion" >Accion</option>
          <option value="terror" >Terror</option>
          <option value="animacion" >Animacion</option>
          <option value="comedia" >Comedia</option>
          <option value="drama" >Drama</option>
          <option value="cifi" >CIFI</option>
        </select>
	<input type="submit" name="sent" value="Buscar" />
	<?php if(isset($_GET['listin'])) echo '<h2>cambios hechos </h2>';?>
    </form>
	

    	<?php if($totalpelis) { do{ ?>
		<table>
			<tr>
				<td><a href="pelicula.php?peliId=<?php echo $pelis['id']; ?>"><img <?php echo 'src="'.$pelis['fotoPeli'].'"'?> width="100" heigth="100"  alt=""></a></td>
				<td><ul>
					<li><?php echo $pelis['nombrePeli']." - ". $pelis['genero']  ?></li>
					<li><?php echo $pelis['descripcion'] ?></li>					
				</ul></td>
			</tr>
		</table>
			


		<?php } while($pelis = mysql_fetch_assoc($resQuerygetpeli)); }else{?>
		<h2>No se encontrataron resultados</h2>

		<?php } ?>
    </div>
	

</body>
</html>