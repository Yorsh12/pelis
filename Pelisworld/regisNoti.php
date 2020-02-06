<?php 
if(!isset($_SESSION)){
  session_start();
  if($_SESSION['userrol'] != 'admin') header("Location: editar.php?nelPROO:V");
}
include('conexiones/conexionLocalhost.php');
include('includes/codigoComun.php');
if(isset($_POST['sent'])){
//validacion de campos vacios
  foreach ($_POST as $calzon => $caca) { 
    
    if($calzon != "foto" ){
    if($caca == "") $error[] = "el campo $calzon debe contener un valor";
    }
  
   //validacion de password
 }
 $formatos = array('.jpg','.png'  );
 $nombreArchivo = $_FILES['foto']['name'];
 $nombreTmpArchivo = $_FILES['foto']['tmp_name'];
 $ext = substr($nombreArchivo, strrpos($nombreArchivo, '.'));
 if(in_array($ext, $formatos)){
  move_uploaded_file($nombreTmpArchivo, "upload/$nombreArchivo");
  $ruta = "upload/$nombreArchivo";

 }else{
  $error[] = "formato de imagen invalido";
 }


 //validamos que no existian errores antes de continuar con el registro en la BD %s string %d int y es sin apostrofe
 if(!isset($error)){
 $queryNotiAdd = sprintf("INSERT INTO noticias (nombreNot, contenido, foto, persona)
  VALUES('%s','%s','%s','%s')",
    mysql_real_escape_string(trim($_POST['nomNoti'])),
    mysql_real_escape_string(trim($_POST['des'])),
    mysql_real_escape_string(trim($ruta)),
    mysql_real_escape_string(trim($_POST['autor']))
  );
  $resQueryNotiAdd = mysql_query($queryNotiAdd, $conexionLocalhost) or die("ocurrio un proble y no se guardo el registro del usuario en 
  la base ded datos... :(");
    if($resQueryNotiAdd){
      header("Location: index.php");
    } 
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
<body >
	<?php include('includes/nev.php'); ?>
  <section >
  	
		<div class="formulario">
      <strong>Estas en:</strong> <a href="cpanel.php">Control Panel</a> &raquo; <a >Registrar noticia</a>
			<?php if(isset($error)){ printMsg($error,"error");} ?>
			<form action="regisNoti.php" method="post" enctype="multipart/form-data">
					<table>
     		 <tr>

        <td><label form="nomNoti">Nombre Noticia:</label></td>
        <td><input type="text" name="nomNoti"/></td>
      </tr>
      <tr>
        <td><label form="des">Descripcion:</label></td>
        <td><textarea name="des" cols="50" rows="10"> </textarea></td>
      </tr>
        <td><label form="foto">foto:</label></td>
        <td><input type="file" name="foto" /></td>
      </tr>
      <tr>
         <tr>
        <td><label form="autor">Autor:</label></td>
        <td><input type="text" name="autor" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><br /><input type="submit" value="Registrar Noticia "  name="sent"/></td>
      </tr>
    </table>
			</form>

			
		</div>

  </section>


</body>
</html>