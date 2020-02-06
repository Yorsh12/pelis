<?php 
if(!isset($_SESSION)){
	session_start();
	
}
include('conexiones/conexionLocalhost.php');
include('includes/codigoComun.php');
if(isset($_POST['sent'])){
	$queryUserAdd = sprintf("INSERT INTO favoritos (idusu, idpeli, nombrePeli, fotoPeli)
  VALUES('%s','%s','%s','%s')",
    mysql_real_escape_string(trim($_POST['idusu'])),
    mysql_real_escape_string(trim($_POST['idpeli'])),
    mysql_real_escape_string(trim($_POST['nombrepeli'])),
    mysql_real_escape_string(trim($_POST['fotopeli']))
  );
  $resQueryUserAdd = mysql_query($queryUserAdd, $conexionLocalhost) or die("ocurrio un proble y no se guardo el registro del usuario en 
  la base ded datos... :(");
    if($resQueryUserAdd){
      header("Location: favoritos.php");
    } 
//Ejecutamos el query
$resQuerygetpeli = mysql_query($queryGetpeli, $conexionLocalhost) or trigger_error(mysql_error(), E_USER_ERROR);
//Hacemos un fetch para extraer el primer registro del recordset
$pelis = mysql_fetch_assoc($resQuerygetpeli);
//Realizamos un conteo de los resultados
$totalpelis = mysql_num_rows($resQuerygetpeli);
}

if(isset($_GET['favId'])){
	$queryDeleteUserFav = sprintf("DELETE FROM favoritos WHERE idFav = %d",
  mysql_real_escape_string(trim($_GET['favId']))

  
);
 $resQueryDeleteUserFav = mysql_query($queryDeleteUserFav, $conexionLocalhost) or trigger_error(mysql_error(), E_USER_ERROR);

}
$queryGetpeli = sprintf("SELECT idFav, idpeli, nombrePeli, fotoPeli FROM favoritos WHERE idusu = '%s' order by idFav desc  " ,
	mysql_real_escape_string(trim($_SESSION['userId']))
	

);
//Ejecutamos el query
$resQuerygetpeli = mysql_query($queryGetpeli, $conexionLocalhost) or trigger_error(mysql_error(), E_USER_ERROR);
//Hacemos un fetch para extraer el primer registro del recordset
$pelis = mysql_fetch_assoc($resQuerygetpeli);
//Realizamos un conteo de los resultados
$totalpelis = mysql_num_rows($resQuerygetpeli);
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
	
	
	
	
	
    </form>
	

    	<?php if($totalpelis) { do{ ?>
		<table>
			<tr>
				<td><a href="pelicula.php?peliId=<?php echo $pelis['idpeli'];?>"><img <?php echo 'src="'.$pelis['fotoPeli'].'"'?> width="100" heigth="100"  alt=""></td></a>
				<td><ul>
					<li><?php echo $pelis['nombrePeli']; ?></li>
					<li><a href="favoritos.php?favId=<?php echo $pelis['idFav'];?>">Eliminar</a></li>
					
				</ul></td>
			</tr>
		</table>
			


		<?php } while($pelis = mysql_fetch_assoc($resQuerygetpeli)); }else{?>
		<h2>No se encontraron peliculas</h2>

		<?php } ?>
    </div>
	

</body>
</html>