<?php 
if(isset($_POST['sent'])){
 $formatos = array('.jpg','.png'  );
 $nombreArchivo = $_FILES['archivo']['name'];
 $nombreTmpArchivo = $_FILES['archivo']['tmp'];
 $ext = substr($nombreArchivo, strrpos($nombreArchivo, '.'));
 if(in_array($ext, $formatos)){
  move_uploaded_file($nombreTmpArchivo, "upload/$nombreArchivo");
  $ruta = "upload/$nombreArchivo";

 }else{
  $error[] = "formato de imagen invalido";
 }
}
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>Document</title>
 </head>
 <body>
 	<form action="pruebas.php" method="post" enctype="multipart/form-data">
	
     		

       
        <label form="foto">Foto(url):</label>
        <input type="file" name="archivo"/>
          
       
        <input type="submit" value="Aceptar "  name="sent"/>
            
       
    </form>
 </body>
 </html>