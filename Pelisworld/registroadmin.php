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
    

    if($caca == "") $error[] = "el campo $calzon debe contener un valor";
    
  
   //validacion de password
 } if($_POST['password'] != $_POST['password2']) $error[] = "password diferentes" ;
 // verifiacar si exixte el correo 
 //generar unquery para buscar el correp en la ase de datos
 $queryValidateEmail = sprintf("SELECT id FROM user WHERE email = '%s'",
  mysql_real_escape_string($_POST['email'])
  );
 //ejecutamos el query
 $resQueryValidateEmail = mysql_query($queryValidateEmail, $conexionLocalhost) or die("NO se pudo ejecutar el query para buscar email");
 //vaidar resulset 
 if(mysql_num_rows($resQueryValidateEmail)){
  $error[] = "el correo ya esta siendo utilizado.";
 } 
 //valdar nickname
 $queryValidatenick = sprintf("SELECT id FROM user WHERE nombre = '%s'",
  mysql_real_escape_string($_POST['nick'])
  );
 //ejecutamos el query
 $resQueryValidateNick = mysql_query($queryValidatenick, $conexionLocalhost) or die("NO se pudo ejecutar el query para buscar email");
 //vaidar resulset 
 if(mysql_num_rows($resQueryValidateNick)){
  $error[] = "el Nickname ya esta siendo utilizado.";
 } 

  
 //validamos que no existian errores antes de continuar con el registro en la BD %s string %d int y es sin apostrofe
 if(!isset($error)){
 $queryUserAdd = sprintf("INSERT INTO user (nombre, email, password,  rol)
  VALUES('%s','%s','%s','%s')",
    mysql_real_escape_string(trim($_POST['nick'])),
    
    mysql_real_escape_string(trim($_POST['email'])),
    mysql_real_escape_string(trim($_POST['password'])),
    
    mysql_real_escape_string(trim($_POST['rol']))
  );
  $resQueryUserAdd = mysql_query($queryUserAdd, $conexionLocalhost) or die("ocurrio un proble y no se guardo el registro del usuario en 
  la base ded datos... :(");
    if($resQueryUserAdd){
      header("Location: cpanel.php");
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
      <strong>Estas en:</strong> <a href="cpanel.php">Control Panel</a> &raquo; <a >Registrar Usuario</a>
			<?php if(isset($error)){ printMsg($error,"error");} ?>
			<form action="registroadmin.php" method="post">
					<table>
     		 <tr>

        <td><label form="nick">Nickname:</label></td>
        <td><input type="text" name="nick" 
        <?php if(isset($_POST['nombre'])) echo 'value="'.$_POST['nombre'].'"'; ?>/></td>
      </tr>
      <tr>
        <td><label form="email">Email:</label></td>
        <td><input type="text" name="email"
        <?php if(isset($_POST['email'])) echo 'value="'.$_POST['email'].'"'; ?>/></td>
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
        <td><label form="rol">Rol:</label></td>
        <td><select id="rol" name="rol" >
          <option value="usu" selected ="selected">Usuario</option>
          <option value="admin" >Administrador</option>
        </select></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><br /><input type="submit" value="Registrar usuario "  name="sent"/></td>
      </tr>
    </table>
			</form>

			
		</div>

  </section>


</body>
</html>