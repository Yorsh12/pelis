<?php 
if(!isset($_SESSION)){
	session_start();
	if(!isset($_GET['peliId'])) header("Location: index.php?nelprro:v"); 
}
include('conexiones/conexionLocalhost.php');
include('includes/codigoComun.php');
if(isset($_GET['peliId'])){
$queryGetpeli = sprintf("SELECT id, nombrePeli, descripcion, video, fotoPeli, descarga, genero FROM peliculas WHERE id='%s' " ,
	mysql_real_escape_string(trim($_GET['peliId']))
	

);
//Ejecutamos el query
$resQuerygetpeli = mysql_query($queryGetpeli, $conexionLocalhost) or trigger_error(mysql_error(), E_USER_ERROR);
//Hacemos un fetch para extraer el primer registro del recordset
$pelis = mysql_fetch_assoc($resQuerygetpeli);

$queryComentario = sprintf("SELECT comentario, nombreusu, fotousu FROM comentario  WHERE idpeli = '%s'",
	mysql_real_escape_string(trim($_GET['peliId']))

	);
$resQueryComentario = mysql_query($queryComentario, $conexionLocalhost) or trigger_error(mysql_error(),E_USER_ERROR);

$comen = mysql_fetch_assoc($resQueryComentario);
}
if(isset($_POST['sent'])){
	$queryUserAdd = sprintf("INSERT INTO comentario (comentario, nombreusu, fotousu, idpeli)
  VALUES('%s','%s','%s','%s')",
    mysql_real_escape_string(trim($_POST['comentario'])),
    mysql_real_escape_string(trim($_SESSION['username'])),
    mysql_real_escape_string(trim($_SESSION['userfoto'])),
    mysql_real_escape_string(trim($_POST['pelisId']))
  );
	$peli = $_POST['pelisId'];
  $resQueryUserAdd = mysql_query($queryUserAdd, $conexionLocalhost) or die("ocurrio un proble y no se guardo el registro del usuario en 
  la base ded datos... :(");
    if($resQueryUserAdd){
      header("Location: pelicula.php?peliId=$peli");
    } 

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
	

<section>
		<div class="pop">
			<h2><?php echo $pelis['nombrePeli']; ?></h2>
			<div>
				<iframe allowFullScreen frameborder="0" height="564" mozallowfullscreen <?php echo 'src="'.$pelis['video'] .'"'?> webkitAllowFullScreen width="640"></iframe>
				<ul>
					<?php if(isset($_SESSION['userId'])){ ?>
					<li><form action="favoritos.php" method="post">
						<input type="hidden" name="idpeli" <?php echo 'value="'.$pelis['id'].'"'; ?>>
						<input type="hidden" name="idusu" <?php echo 'value="'.$_SESSION['userId'].'"'; ?>>
                        <input type="hidden" name="fotopeli" <?php echo 'value="'.$pelis['fotoPeli'].'"'; ?>>
                        <input type="hidden" name="nombrepeli" <?php echo 'value="'.$pelis['nombrePeli'].'"'; ?>>
                        <input type="submit" name="sent" value="favorito">
					</form></li>
					<?php } ?>
					<li><a <?php echo 'href="'.$pelis['descarga'].'"' ?>>descargar</a></li>
				</ul>
			</div>
			<div>
				<p>descripcion</p>
				<?php echo $pelis['descripcion'] ?>
			</div>

			<div>
				<?php if(isset($_SESSION['userId'])){ ?>
				<form action="pelicula.php" method="post">
					<table>
						<tr>
							<td><ul>
								<input type="hidden" name="pelisId" <?php echo 'value="'.$pelis['id'].'"'; ?>>
								<li><img <?php echo 'src="'.$_SESSION['userfoto'].'"' ?> alt=""></li>
								<li><?php echo $_SESSION['username'];?></li>
							</ul></td>
							<td><textarea name="comentario" cols="50" rows="10"></textarea></td>
							<tr>
								<td>&nbsp;</td>
								<td><input type="submit" value="aceptar" name="sent"></td>
							</tr>
						</tr>
					</table>
					
				</form>
			<table>
				<?php } 

					if($comen){ do{ 
				?>
						<tr>
							<td><ul>
								<input type="hidden" name="pelisId" <?php echo 'value="'.$pelis['id'].'"'; ?>>
								<li><img <?php echo 'src="'.$comen['fotousu'].'"' ?> alt=""></li>
								<li><?php echo $comen['nombreusu'];?></li>
							</ul></td>
							<td><p><?php echo $comen['comentario'] ?></p></td>
							
						</tr>
					</table>
				<?php } while($comen = mysql_fetch_assoc($resQueryComentario)); }else{?>
		<h2>No se encontraron comentarios</h2>

		<?php } ?>

			</div>
		</div>



</section>


















   

</script>
</body>
</html>