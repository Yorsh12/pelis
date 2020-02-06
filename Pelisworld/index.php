<?php 
if(!isset($_SESSION)){
	session_start();
}
include('conexiones/conexionLocalhost.php');
include('includes/codigoComun.php');

 ?>
<!DOCTYPE html PUBLIC>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	
	<link href="css/estiluchos.css"  rel="stylesheet" >

</head>
<body>
	<?php include('includes/nev.php'); ?>
	<div class="w3-content w3-section" style="max-width:100%">
  <img class="mySlides" src="img/1.jpg" style="width:100%">
  <img class="mySlides" src="img/2.jpg" style="width:100%">
  <img class="mySlides" src="img/3.jpg" style="width:100%">
</div>


















<script>
var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}    
    x[myIndex-1].style.display = "block";  
    setTimeout(carousel, 2000); // Change image every 2 seconds
}
</script>
   

</script>
</body>
</html>