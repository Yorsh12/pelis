<?php 
if(!isset($_SESSION)){
  session_start();
  if(!isset($_SESSION['userId'])) header("Location: index.php?nelprro:v");
}
include('conexiones/conexionLocalhost.php');
include('includes/codigoComun.php');

$queryFoto = sprintf("SELECT foto FROM user 
      WHERE  id = '%s'", 
      mysql_real_escape_string(trim($_SESSION['userId']))
      );
      
    //ejecutamos el query
    $resQueryFoto = mysql_query($queryFoto, $conexionLocalhost) or die("No se pudo ejecutar el query de validacion de usuario");
    //conectaos el numero de regitros encontrados, esperamos 0 ó 1, 0 = que no se encontro el email/passwor 
    if(mysql_num_rows($resQueryFoto)){
      $userData = mysql_fetch_assoc($resQueryFoto);
      $_SESSION['foto'] = $userData['foto'];
      
      }


if(isset($_POST['sent'])){
//validacion de campos vacios
foreach ($_POST as $calzon => $caca) {
  if($calzon != "archivo"){
    if($caca == "") $error[] = "el campo $calzon debe contener un valor";
  }
}


  if($_POST['password'] != ""){
 if($_POST['password'] != $_POST['password2']) $error[] = "password diferentes" ;
 }

 $formatos = array('.jpg','.png'  );
 $nombreArchivo = $_FILES['archivo']['name'];
 $nombreTmpArchivo = $_FILES['archivo']['tmp_name'];
 $ext = substr($nombreArchivo, strrpos($nombreArchivo, '.'));
 if(in_array($ext, $formatos)){
  move_uploaded_file($nombreTmpArchivo, "upload/$nombreArchivo");
  $ruta = "upload/$nombreArchivo";
 }

 


if(!isset($error)){
  if($ruta !=""){
     $queryUserupdate = sprintf("UPDATE user SET nombre = '%s', foto = '%s', password = '%s' WHERE id=%d",
    mysql_real_escape_string(trim($_POST['nick'])),
    mysql_real_escape_string(trim($ruta)),
    mysql_real_escape_string(trim($_POST['password'])),
    mysql_real_escape_string(trim($_SESSION['userId']))
  );
  $resQueryUserUpdate = mysql_query($queryUserupdate, $conexionLocalhost) or die("ocurrio un proble y no se guardo el registro del usuario en 
  la base ded datos... :(");
    header("Location: editar.php?listin");
    }else{
    $queryUserupdate = sprintf("UPDATE user SET nombre = '%s', password = '%s' WHERE id=%d",
    mysql_real_escape_string(trim($_POST['nick'])),
    mysql_real_escape_string(trim($_POST['password'])),
    mysql_real_escape_string(trim($_SESSION['userId']))
  );
  $resQueryUserUpdate = mysql_query($queryUserupdate, $conexionLocalhost) or die("ocurrio un proble y no se guardo el registro del usuario en 
  la base ded datos... :(");
    header("Location: editar.php?listin");
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
    <?php if(isset($error)){ printMsg($error,"error");} ?>
    <div>
     <?php if(isset($_SESSION['userfoto'])) {?>
     <img <?php echo 'src="'.$_SESSION['foto'].'"'?> width="200" heigth="200"  alt="">
     <?php }else{ ?>
     <img src="https://www.madelan.com.ar/tmp/617.jpg" width="200" heigth="200" alt=""> 
      
     <?php } ?>
    </div>
		<div >
      
			
			<form action="editar.php" method="post" enctype="multipart/form-data">
      <table>
      
         <tr>
        <td><label form="nick">Nickname:</label></td>
        <td><input type="text" name="nick" 
        <?php echo 'value="'.$_SESSION['username'].'"'; ?>/></td>
      </tr>
     <tr>
        <td><label form="email">Email:</label></td>
        <td><input type="text" name="email" disabled="disabled"
        <?php echo 'value="'.$_SESSION['userEmail'].'"'; ?>/></td>
      </tr>
      <tr>
        <td><label form="password">Password:</label></td>
        <td><input type="password" name="password" /></td>
      </tr>
      <tr>
        <td><label form="password2">Confirmar Password:</label></td>
        <td><input type="password" name="password2" /></td>
      </tr>
      
      <tr>
      <tr>
        <td><label form="archivo">Foto:</label></td>
        <td><input class="formu" type="file" name="archivo"/></td>
      </tr>
      
      <tr>
      <tr>
        <td>&nbsp;</td>
        <td><br /><input type="submit" value="Aceptar "  name="sent"/></td>
      </tr>
      
     
      
     
     
    </table>
			</form>

			
		</div>

  </section>


</body>
</html>