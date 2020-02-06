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
 // verifiacar si exixte el correo 
 //generar unquery para buscar el correp en la ase de datos
 $queryValidatepeli = sprintf("SELECT id FROM peliculas WHERE nombrePeli = '%s'",
  mysql_real_escape_string($_POST['nompeli'])
  );
 //ejecutamos el query
 $resQueryValidatepeli = mysql_query($queryValidatepeli, $conexionLocalhost) or die("NO se pudo ejecutar el query para buscar pelicula");
 //vaidar resulset 
 if(mysql_num_rows($resQueryValidatepeli)){
  $error[] = "la pelicula ya existe.";
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
 $queryPeliadd = sprintf("INSERT INTO peliculas (nombrePeli, descripcion, video, fotoPeli, anioPeli, descarga, genero)
  VALUES('%s','%s','%s','%s','%s','%s','%s')",
    mysql_real_escape_string(trim($_POST['nompeli'])),
    mysql_real_escape_string(trim($_POST['des'])),
    mysql_real_escape_string(trim($_POST['video'])),
    mysql_real_escape_string(trim($ruta)),
    mysql_real_escape_string(trim($_POST['anio'])),
    mysql_real_escape_string(trim($_POST['descarga'])),
    mysql_real_escape_string(trim($_POST['genero']))
  );
  $resQueryPeliadd = mysql_query($queryPeliadd, $conexionLocalhost) or die("ocurrio un proble y no se guardo el registro del usuario en 
  la base ded datos... :(");
    if($resQueryPeliadd){
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
      <strong>Estas en:</strong> <a href="cpanel.php">Control Panel</a> &raquo; <a >Registrar Pelicula</a>
			<?php if(isset($error)){ printMsg($error,"error");} ?>
			<form action="regisPelis.php" method="post" enctype="multipart/form-data">
					<table>
     		 <tr>

        <td><label form="nompeli">Nombre Pelicula:</label></td>
        <td><input type="text" name="nompeli"/></td>
      </tr>
      <tr>
        <td><label form="des">Descripcion:</label></td>
        <td><textarea name="des" cols="50" rows="10"> </textarea></td>
      </tr>
      <tr>
        <td><label form="video">Video(URL):</label></td>
        <td><input type="text" name="video" /></td>
      </tr>
      <tr>
        <td><label form="foto">foto:</label></td>
        <td><input type="file" name="foto" /></td>
      </tr>
      <tr>
         <tr>
        <td><label form="anio">Año:</label></td>
        <td><input type="text" name="anio" /></td>
      </tr>
      <tr>
        <tr>
        <td><label form="deascarga">Descarga(URL):</label></td>
        <td><input type="text" name="descarga" /></td>
      </tr>
      <tr>
        <td><label form="genero">Genero:</label></td>
        <td><select id="genero" name="genero" >
          <option value="" selected ="selected">Seleciona genero</option>
          <option value="accion" >Accion</option>
          <option value="terror" >Terror</option>
          <option value="animacion" >Animacion</option>
          <option value="comedia" >Comedia</option>
          <option value="drama" >Drama</option>
          <option value="cifi" >CIFI</option>
        </select></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><br /><input type="submit" value="Registrar Pelicula "  name="sent"/></td>
      </tr>
    </table>
			</form>

			
		</div>

  </section>


</body>
</html>