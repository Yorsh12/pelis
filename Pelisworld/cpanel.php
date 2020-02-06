<?php 
if(!isset($_SESSION)){
	session_start();
  if($_SESSION['userrol'] != 'admin') header("Location: editar.php?nelPROO:V");
}
include('conexiones/conexionLocalhost.php');
include('includes/codigoComun.php');

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
	
	
	<strong>Estas en:</strong> <a>Control Panel</a> 
	<ul>
    <h3>Peliculas</h3>
    <li><a href="regisPelis.php">Agregar Peliculas</a></li>
    <li><a href="buscarPeli.php">Buscar Peliculas</a></li>
  </ul>
  <ul>
    <h3>Usuarios</h3>
    <li><a href="registroAdmin.php">Registrar usuarios</a></li>
    <li><a href="buscarUser.php">Buscar usuarios</a></li>
  </ul>
  <ul>
    <h3>Noticias</h3>
    <li><a href="regisNoti.php">Agregar Noticias</a></li>
    <li><a href="buscarNoti.php">Buscar Noticias</a></li>
  </ul>

			


</body>
</html>