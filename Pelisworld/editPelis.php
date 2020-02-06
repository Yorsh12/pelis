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

if(!isset($error)){

  if($ruta != ""){
    $queryPeliupdate = sprintf("UPDATE peliculas SET nombrePeli= '%s', descripcion= '%s',video= '%s', fotoPeli= '%s', anioPeli= '%s', descarga= '%s', genero= '%s' WHERE id=%d",
    mysql_real_escape_string(trim($_POST['nompeli'])),
    mysql_real_escape_string(trim($_POST['des'])),
    mysql_real_escape_string(trim($_POST['video'])),
    mysql_real_escape_string(trim($ruta)),
    mysql_real_escape_string(trim($_POST['anio'])),
    mysql_real_escape_string(trim($_POST['descarga'])),
    mysql_real_escape_string(trim($_POST['genero'])),        
    mysql_real_escape_string(trim($_POST['peliId']))
  );
  $resQueryPeliUpdate = mysql_query($queryPeliupdate, $conexionLocalhost) or die("ocurrio un proble y no se guardo el registro del usuario en 
  la base ded datos... :(");
    header("Location: buscarPeli.php?listin");
}else{
   $queryPeliupdate = sprintf("UPDATE peliculas SET nombrePeli= '%s', descripcion= '%s',video= '%s', anioPeli= '%s', descarga= '%s', genero= '%s' WHERE id=%d",
    mysql_real_escape_string(trim($_POST['nompeli'])),
    mysql_real_escape_string(trim($_POST['des'])),
    mysql_real_escape_string(trim($_POST['video'])),
    mysql_real_escape_string(trim($_POST['anio'])),
    mysql_real_escape_string(trim($_POST['descarga'])),
    mysql_real_escape_string(trim($_POST['genero'])),        
    mysql_real_escape_string(trim($_POST['peliId']))
  );
  $resQueryPeliUpdate = mysql_query($queryPeliupdate, $conexionLocalhost) or die("ocurrio un proble y no se guardo el registro del usuario en 
  la base ded datos... :(");
    header("Location: buscarPeli.php?listin");
  }
}
}else{
  $queryPeli = sprintf("SELECT id, nombrePeli, descripcion,video, fotoPeli, anioPeli, descarga, genero FROM peliculas 
      WHERE  id = '%s'", 
      mysql_real_escape_string(trim($_GET['peliId']))
      );
      
    //ejecutamos el query
    $resQueryPeli = mysql_query($queryPeli, $conexionLocalhost) or die("No se pudo ejecutar el query de validacion de usuario");
    //conectaos el numero de regitros encontrados, esperamos 0 ó 1, 0 = que no se encontro el email/passwor 
      $peliData = mysql_fetch_assoc($resQueryPeli);
      


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
      <strong>Estas en:</strong> <a href="cpanel.php">Control Panel</a> &raquo; <a href="buscarPeli.php" >Buscar Peliculas</a> &raquo; <a >Editar Peliculas</a>
			<?php if(isset($error)){ printMsg($error,"error");} ?>
      <?php if($peliData['fotoPeli']  !="") {?>
     <img <?php echo 'src="'.$peliData['fotoPeli'].'"'?> width="200" heigth="200"  alt="">
     <?php }else{ ?>
     <img src="https://www.madelan.com.ar/tmp/617.jpg" width="200" heigth="200" alt=""> 
      
     <?php } ?>
			<form action="editPelis.php" method="post" enctype="multipart/form-data">
					<input type="hidden" name="peliId" <?php echo 'value="'.$peliData['id'].'"'; ?> />
          <table>
     		 <tr>

        <td><label form="nompeli">Nombre Pelicula:</label></td>
        <td><input type="text" name="nompeli"
          <?php echo 'value="'.$peliData['nombrePeli'].'"'; ?> /></td>
      </tr>
      <tr>
        <td><label form="des">Descripcion:</label></td>
        <td><textarea name="des" cols="50" rows="10"><?php echo $peliData['descripcion']; ?> </textarea></td>
      </tr>
      <tr>
        <td><label form="video">Video(URL):</label></td>
        <td><input type="text" name="video"
        <?php echo 'value="'.$peliData['video'].'"'; ?>  /></td>
      </tr>
      <tr>
        <td><label form="archivo">foto:</label></td>
        <td><input type="file" name="archivo" /></td>
      </tr>
      <tr>
         <tr>
        <td><label form="anio">Año:</label></td>
        <td><input type="text" name="anio" 
          <?php echo 'value="'.$peliData['anioPeli'].'"'; ?> /></td>
      </tr>
      <tr>
        <tr>
        <td><label form="deascarga">Descarga(URL):</label></td>
        <td><input type="text" name="descarga" 
          <?php echo 'value="'.$peliData['descarga'].'"'; ?> /></td>
      </tr>
      <tr>
        <td><label form="genero">Genero:</label></td>
        <td><select id="genero" name="genero" >
          <option value="accion" <?php if($peliData['genero'] == "accion") echo 'selected = "selected"'; ?> >Accion</option>
          <option value="terror" <?php if($peliData['genero'] == "terror") echo 'selected = "selected"'; ?> >Terror</option>
          <option value="animacion" <?php if($peliData['genero'] == "animacion") echo 'selected = "selected"'; ?> >Animacion</option>
          <option value="comedia" <?php if($peliData['genero'] == "comedia") echo 'selected = "selected"'; ?> >Comedia</option>
          <option value="drama" <?php if($peliData['genero'] == "drama") echo 'selected = "selected"'; ?> >Drama</option>
          <option value="cifi" <?php if($peliData['genero'] == "cifi") echo 'selected = "selected"'; ?> >CIFI</option>
        </select></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><br /><input type="submit" value="editar Pelicula "  name="sent"/></td>
      </tr>
    </table>
			</form>

			
		</div>

  </section>


</body>
</html>








