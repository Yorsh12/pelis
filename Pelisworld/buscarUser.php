<?php 
if(!isset($_SESSION)){
	session_start();
	if($_SESSION['userrol'] != 'admin') header("Location: editar.php?nelPROO:V");
}
include('conexiones/conexionLocalhost.php');
include('includes/codigoComun.php');
if(isset($_GET['valor'])){
$queryGetusuario = sprintf("SELECT id, nombre, email, foto, rol FROM user WHERE nombre LIKE '%s'",
	mysql_real_escape_string(trim("%".$_GET['valor']."%"))

);
//Ejecutamos el query
$resQuerygetusuario = mysql_query($queryGetusuario, $conexionLocalhost) or trigger_error(mysql_error(), E_USER_ERROR);
//Hacemos un fetch para extraer el primer registro del recordset
$usuarios = mysql_fetch_assoc($resQuerygetusuario);
//Realizamos un conteo de los resultados
$totalUsuarios = mysql_num_rows($resQuerygetusuario);
}else{
$queryGetusuario = "SELECT id, nombre, email, foto, rol FROM user";
//Ejecutamos el query
$resQuerygetusuario = mysql_query($queryGetusuario, $conexionLocalhost) or trigger_error(mysql_error(), E_USER_ERROR);
//Hacemos un fetch para extraer el primer registro del recordset
$usuarios = mysql_fetch_assoc($resQuerygetusuario);
//Realizamos un conteo de los resultados
$totalUsuarios = mysql_num_rows($resQuerygetusuario);

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
	<strong>Estas en:</strong> <a href="cpanel.php">Control Panel</a> &raquo; <a >Buscar Usuarios</a>
	<form action="buscarUser.php" method="get">
  	<label for="valor">Buscar:</label>
  	<input type="text" name="valor" />
	<input type="submit" name="sent" value="Buscar" />
	<?php if(isset($_GET['listin'])) echo '<h2>cambios hechos </h2>';?>
    </form>
    	<?php if($totalUsuarios){ do{ ?>
		<table>
			<tr>
				<td><img <?php echo 'src="'.$usuarios['foto'].'"'?> width="100" heigth="100"  alt=""</td>
				<td><ul>
					<li><?php echo $usuarios['nombre']." - ". $usuarios['email']." - ".$usuarios['rol']  ?></li>
					<li><a href="editusu.php?userId=<?php echo $usuarios['id'];?>">Editar</a> | <a href="delete.php?userId=<?php echo $usuarios['id'];?>">Eliminar</a></li>
				</ul></td>
			</tr>
		</table>
			


		<?php } while($usuarios = mysql_fetch_assoc($resQuerygetusuario)); }else{?>
		<h2>No se encontrataron resultados</h2>

		<?php } ?>
    </div>
	

</body>
</html>