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
    $queryUserupdate = sprintf("UPDATE user SET nombre = '%s', foto = '%s', rol = '%s' WHERE id=%d",
    mysql_real_escape_string(trim($_POST['nick'])),
    mysql_real_escape_string(trim($ruta)),
    mysql_real_escape_string(trim($_POST['rol'])),
    mysql_real_escape_string(trim($_POST['userId']))
  );
  $resQueryUserUpdate = mysql_query($queryUserupdate, $conexionLocalhost) or die("ocurrio un proble y no se guardo el registro del usuario en 
  la base ded datos... :(");
    header("Location: buscarUser.php?listin");
  }
}
}else{
  $queryUserupdate = sprintf("UPDATE user SET nombre = '%s', rol = '%s' WHERE id=%d",
    mysql_real_escape_string(trim($_POST['nick'])),
    mysql_real_escape_string(trim($_POST['rol'])),
    mysql_real_escape_string(trim($_POST['userId']))
  );
   
  $resQueryUserUpdate = mysql_query($queryUserupdate, $conexionLocalhost) or die("ocurrio un proble y no se guardo el registro del usuario en 
  la base ded datos... :(");
    header("Location: buscarUser.php?listin");
  }


}else{
  $queryUser = sprintf("SELECT id, nombre, email, foto, rol FROM user 
      WHERE  id = '%s'", 
      mysql_real_escape_string(trim($_GET['userId']))
      );
      
    //ejecutamos el query
    $resQueryUser = mysql_query($queryUser, $conexionLocalhost) or die("No se pudo ejecutar el query de validacion de usuario");
    //conectaos el numero de regitros encontrados, esperamos 0 ó 1, 0 = que no se encontro el email/passwor 
      $userData = mysql_fetch_assoc($resQueryUser);
      


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
      <strong>Estas en:</strong> <a href="cpanel.php">Control Panel</a> &raquo; <a href="buscarUser.php" >Buscar Usuarios</a> &raquo; <a >Editar Usuarios</a>
			<?php if(isset($error)){ printMsg($error,"error");} ?>
      <div>
     <?php if($userData['foto']  !="" ) {?>
     <img <?php echo 'src="'.$userData['foto'].'"'?> width="200" heigth="200"  alt="">
     <?php }else{ ?>
     <img src="https://www.madelan.com.ar/tmp/617.jpg" width="200" heigth="200" alt=""> 
      
     <?php } ?>
    </div>
			<form action="editusu.php" method="post" enctype="multipart/form-data">
					<table>
     		 <tr>
        <input type="hidden" name="userId" <?php echo 'value="'.$userData['id'].'"'; ?> />
        <td><label form="nick">Nickname:</label></td>
        <td><input type="text" name="nick" 
        <?php echo 'value="'.$userData['nombre'].'"'; ?>/></td>
      </tr>
      <tr>
        <td><label form="email">Email:</label></td>
        <td><input type="text" name="email" disabled="disabled"
        <?php echo 'value="'.$userData['email'].'"'; ?>/></td>
      </tr>
     <tr>
        <td><label form="archivo">Foto:</label></td>
        <td><input class="formu" type="file" name="archivo"/></td>
      </tr>
      <tr>
        <tr>
        <td><label form="rol">Rol:</label></td>
        <td><select id="rol" name="rol" >
          <option value="usu" <?php if($userData['rol'] == "usu") echo 'selected = "selected"'; ?>>Usuario</option>
          <option value="admin" <?php if($userData['rol'] == "admin") echo 'selected = "selected"'; ?>>Administrador</option>
        </select></td>
      </tr> 
        <td>&nbsp;</td>
        <td><br /><input type="submit" value="Editar usuario "  name="sent"/></td>
      </tr>
    </table>
			</form>

			
		</div>

  </section>


</body>
</html>