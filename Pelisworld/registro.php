<?php 
if(!isset($_SESSION)){
  session_start();
  if(isset($_SESSION['userId'])) header("Location: index.php?nelprro:v");
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
  VALUES('%s','%s','%s','usu')",
    mysql_real_escape_string(trim($_POST['nick'])),
    
    mysql_real_escape_string(trim($_POST['email'])),
    mysql_real_escape_string(trim($_POST['password']))
  );
  $resQueryUserAdd = mysql_query($queryUserAdd, $conexionLocalhost) or trigger_error(mysql_error(), E_USER_ERROR);
    if($resQueryUserAdd){
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
			<?php if(isset($error)){ printMsg($error,"error");} ?>
			<form action="registro.php" method="post">
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
        <td>&nbsp;</td>
        <td><br /><input type="submit" value="Registrar usuario "  name="sent"/></td>
      </tr>
    </table>
			</form>

			
		</div>

  </section>


</body>
</html>