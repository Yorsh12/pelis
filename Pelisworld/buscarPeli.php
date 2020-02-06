<?php 
if(!isset($_SESSION)){
	session_start();
	if($_SESSION['userrol'] != 'admin') header("Location: editar.php?nelPROO:V");
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
	<strong>Estas en:</strong> <a href="cpanel.php">Control Panel</a> &raquo; <a >Buscar Peliculas</a>	
	<form action="buscarPeli.php" method="get">
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
				<td><img <?php echo 'src="'.$pelis['fotoPeli'].'"'?> width="100" heigth="100"  alt=""</td>
				<td><ul>
					<li><?php echo $pelis['nombrePeli']." - ". $pelis['genero']  ?></li>
					<li><?php echo $pelis['descripcion'] ?></li>
					<li><a href="editPelis.php?peliId=<?php echo $pelis['id'];?>">Editar</a> | <a href="delete.php?pelisId=<?php echo $pelis['id'];?>">Eliminar</a></li>
				</ul></td>
			</tr>
		</table>
			


		<?php } while($pelis = mysql_fetch_assoc($resQuerygetpeli)); }else{?>
		<h2>No se encontraron resultados</h2>

		<?php } ?>
    </div>
	

</body>
</html>