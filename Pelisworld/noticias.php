<?php 
if(!isset($_SESSION)){
	session_start();
}
include('conexiones/conexionLocalhost.php');
include('includes/codigoComun.php');

$queryGetNoticia = "SELECT idnot, nombrenot, contenido, foto, persona FROM noticias order by idnot desc";

//Ejecutamos el query
$resQuerygetNoticia = mysql_query($queryGetNoticia, $conexionLocalhost) or trigger_error(mysql_error(), E_USER_ERROR);

//Hacemos un fetch para extraer el primer registro del recordset
$noticias = mysql_fetch_assoc($resQuerygetNoticia);


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
	
	
	<?php do{ ?>
	<div class="noticia">

			<ul>
				<li><img <?php echo 'src="'.$noticias['foto'].'"'?> width="200" heigth="200"  alt=""></li>
				<li><p><?php echo $noticias['nombrenot']; ?></p></li>
				<li><p><?php echo $noticias['contenido']; ?></p></li>
				<li><p><?php echo $noticias['persona']; ?></p></li>
				

			</ul>
    </div>
	<?php } while($noticias = mysql_fetch_assoc($resQuerygetNoticia)); ?>


</body>
</html>