<?php 
if(!isset($_SESSION)){
	session_start();
	if($_SESSION['userrol'] != 'admin') header("Location: editar.php?nelPROO:V");
}
include('conexiones/conexionLocalhost.php');
if(isset($_GET['userId'])){
	$queryDeleteUserData = sprintf("DELETE FROM user WHERE id = %d",
  mysql_real_escape_string(trim($_GET['userId']))
);

$resQueryDeleteUserData = mysql_query($queryDeleteUserData, $conexionLocalhost) or trigger_error(mysql_error(), E_USER_ERROR);


$queryDeleteUserFav = sprintf("DELETE FROM favoritos WHERE idusu = %d",
  mysql_real_escape_string(trim($_GET['userId']))

  
);
 $resQueryDeleteUserFav = mysql_query($queryDeleteUserFav, $conexionLocalhost) or trigger_error(mysql_error(), E_USER_ERROR);
header("Location: buscarUser.php?listin=true");
}

if(isset($_GET['pelisId'])){
	$queryDeletePeliData = sprintf("DELETE FROM peliculas WHERE id = %d",
  mysql_real_escape_string(trim($_GET['pelisId']))
);

$resQueryDeletePeliData = mysql_query($queryDeletePeliData, $conexionLocalhost) or trigger_error(mysql_error(), E_USER_ERROR);

$queryDeletePeliFav = sprintf("DELETE FROM favoritos WHERE idpeli = %d",
  mysql_real_escape_string(trim($_GET['pelisId']))
);
$resQueryDeletePeliFav = mysql_query($queryDeletePeliFav, $conexionLocalhost) or trigger_error(mysql_error(), E_USER_ERROR);

header("Location: buscarPeli.php?listin=true");
}

if(isset($_GET['notiId'])){
	$queryDeleteNotiData = sprintf("DELETE FROM noticias WHERE idnot = %d",
  mysql_real_escape_string(trim($_GET['notiId']))
);

$resQueryDeleteNotiData = mysql_query($queryDeleteNotiData, $conexionLocalhost) or trigger_error(mysql_error(), E_USER_ERROR);
header("Location: buscarNoti.php?listin=true");
}





 ?>