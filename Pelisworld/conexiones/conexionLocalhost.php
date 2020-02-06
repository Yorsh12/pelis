<?php

$servidor = 'localhost';
$baseDatos = 'pelisworld';
$usuarioBd = 'root';
$passwordBd = '1234';

$conexionLocalhost = mysql_connect($servidor, $usuarioBd, $passwordBd)
    or trigger_error(mysql_error(), E_USER_ERROR);

mysql_query("SET NAMES 'utf8");
mysql_select_db($baseDatos, $conexionLocalhost);

 ?>
