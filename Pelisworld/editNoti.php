<?php 
if(!isset($_SESSION)){
  session_start();
  
}
include('conexiones/conexionLocalhost.php');
include('includes/codigoComun.php');
if(isset($_POST['sent'])){
//validacion de campos vacios 
    foreach ($_POST as $calzon => $caca) { 
    
    if($calzon != "archivo"){
    if($caca == "") $error[] = "el campo $calzon debe contener un valor";
    
   }
   }



 $formatos = array('.jpg','.png'  );
 $nombreArchivo = $_FILES['archivo']['name'];
 $nombreTmpArchivo = $_FILES['archivo']['tmp_name'];
 $ext = substr($nombreArchivo, strrpos($nombreArchivo, '.'));
 if(in_array($ext, $formatos)){
  move_uploaded_file($nombreTmpArchivo, "upload/$nombreArchivo");
  $ruta = "upload/$nombreArchivo";
}
 
if($ruta != ""){
if(!isset($error)){
  if(!isset($error)){
     $queryUserupdate = sprintf("UPDATE noticias SET  nombreNot = '%s', foto ='%s', contenido = '%s', persona= '%s' WHERE idnot=%d",
    mysql_real_escape_string(trim($_POST['nomNoti'])),
    mysql_real_escape_string(trim($ruta)),
    mysql_real_escape_string(trim($_POST['des'])),
    mysql_real_escape_string(trim($_POST['autor'])),
    mysql_real_escape_string(trim($_POST['notiId']))
  );
  $resQueryUserUpdate = mysql_query($queryUserupdate, $conexionLocalhost) or die("ocurrio un proble y no se guardo el registro del usuario en 
  la base ded datos... :(");
    header("Location: buscarNoti.php?listin");
  }
}
}else{
   $queryUserupdate = sprintf("UPDATE noticias SET  nombreNot = '%s', contenido = '%s', persona= '%s' WHERE idnot=%d",
    mysql_real_escape_string(trim($_POST['nomNoti'])),
    mysql_real_escape_string(trim($_POST['des'])),
    mysql_real_escape_string(trim($_POST['autor'])),
    mysql_real_escape_string(trim($_POST['notiId']))
  );
  $resQueryUserUpdate = mysql_query($queryUserupdate, $conexionLocalhost) or die("ocurrio un proble y no se guardo el registro del usuario en 
  la base ded datos... :(");
    header("Location: buscarNoti.php?listin");
  }

}else{
  $querynoti = sprintf("SELECT idnot, nombreNot, contenido, foto, persona FROM noticias
      WHERE  idnot = '%s'", 
      mysql_real_escape_string(trim($_GET['notiId']))
      );
      
    //ejecutamos el query
    $resQuerynoti = mysql_query($querynoti, $conexionLocalhost) or trigger_error(mysql_error(), E_USER_ERROR);
    //conectaos el numero de regitros encontrados, esperamos 0 ó 1, 0 = que no se encontro el email/passwor 
      $notiData = mysql_fetch_assoc($resQuerynoti);
      


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
      <strong>Estas en:</strong> <a href="cpanel.php">Control Panel</a> &raquo; <a href="buscarNoti.php" >Buscar Noticias</a> &raquo; <a >Editar Noticias</a>
      <?php if(isset($error)){ printMsg($error,"error");} ?>
      <?php if($notiData['foto'] !="") {?>
     <img <?php echo 'src="'.$notiData['foto'].'"'?> width="200" heigth="200"  alt="">
     <?php }else{ ?>
     <img src="https://www.madelan.com.ar/tmp/617.jpg" width="200" heigth="200" alt=""> 
      
     <?php } ?>
			<?php if(isset($error)){ printMsg($error,"error");} ?>
			<form action="editNoti.php" method="post" enctype="multipart/form-data">
					<table>

     		 <tr>
        <input type="hidden" name="notiId" <?php echo 'value="'.$notiData['idnot'] .'"' ?>/>
        <td><label form="nomNoti">Nombre Noticia:</label></td>
        <td><input type="text" name="nomNoti"
          <?php echo 'value="'.$notiData['nombreNot'] .'"' ?>/></td>
      </tr>
      <tr>
        <td><label form="des">Descripcion:</label></td>
        <td><textarea name="des" cols="50" rows="10"><?php echo $notiData['contenido'] ?> </textarea></td>
      </tr>
        <td><label form="archivo">foto:</label></td>
        <td><input type="file" name="archivo" /></td>
      </tr>
      <tr>
         <tr>
        <td><label form="autor">Autor:</label></td>
        <td><input type="text" name="autor" 
          <?php echo 'value="'.$notiData['persona'].'"'; ?>/></td>
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