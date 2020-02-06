<?php 
if(!isset($_SESSION)){
	session_start();
	if(isset($_SESSION['userId'])) header("Location: index.php?nelprro:v");
}
include('conexiones/conexionLocalhost.php');
include('includes/codigoComun.php');
if (isset($_POST['sent'])) {
	//validacion de campos vacios
	foreach ($_POST as $calzon => $caca) {
		if($caca == "") $error[] = "El campo $calzon es abligatorio";
	}
	//continuamos con la ejecucion de instruciones a la base de datos solamente cuando no hay errores
	if(!isset($error)){
		//definimos el query a ejecutar, se debe validar el correo y el password proporcionados por el usuario
		$queryValidateUser = sprintf("SELECT id, email, nombre, foto, rol, password FROM user 
			WHERE  email ='%s' AND password = '%s'", 

			mysql_real_escape_string(trim($_POST['email'])),
			mysql_real_escape_string(trim($_POST['password']))
			);
			
		//ejecutamos el query
		$resQueryValidateUser = mysql_query($queryValidateUser, $conexionLocalhost) or die("No se pudo ejecutar el query de validacion de usuario");
		//conectaos el numero de regitros encontrados, esperamos 0 ó 1, 0 = que no se encontro el email/passwor 
		if(mysql_num_rows($resQueryValidateUser)){
			$userData = mysql_fetch_assoc($resQueryValidateUser);
 			$_SESSION['userId'] = $userData['id'];
 			$_SESSION['userEmail'] = $userData['email'];
 			$_SESSION['username'] = $userData['nombre'];
 			$_SESSION['userfoto'] = $userData['foto'];
 			$_SESSION['userrol'] = $userData['rol'];
 			$_SESSION['userpassword'] = $userData['password'];

 			header("location: index.php");
	    }else{
	    	$error[] = "No fue posible validar tu email y/o password, verufica tus datos";

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
			<form action="login.php" method="post">
				<table>
					<tr>
						<td><label for="email">Email:</label></td>
						<td><input type="text"  name="email"></td>
					</tr>

					<tr>
						<td><label for="password">Password:</label></td>
						<td><input type="password" name="password" ></td>
					</tr>
						
					<tr>
						<td>&nbsp;</td>
						<td></br><input type="submit" name="sent" value="Iniciar"></td>
					</tr>
				    <tr>
						<td>&nbsp;</td>
						<td></br><a href="registro.php">¿No tienes cuenta?</a></td>
					</tr>

					
				</table>	
			</form>

			
		</div>

  </section>


</body>
</html>