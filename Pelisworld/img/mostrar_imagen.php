<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Mostrar Imagen</title>
  </head>
  <body>
    <center>
      <table border="2">
        <thead>
          <tr>
            <th>id</th>
            <th>Nombre</th>
            <th>Imagen</th>
            <th>Operaciones</th>
          </tr>
        </thead>
        <tbody>
          <?php
            include('conexiones/conexionLocalhost.php');

            $query = "SELECT * FROM tabla_imagen";
            $resultado = $conexionLocalhost->query($query);
            while ($row = $resultado->fetch_assoc()) {
          ?>
            <tr>
              <td><?php echo $row['id']; ?></td>
              <td><?php echo $row['nombre']; ?></td>
              <td><img height="50px" src="data:image/jpg;base64,<?php echo base64_encode($row['Imagen']); ?>"/></td>
              <th><a href="#">Modificar</a></th>
              <th><a href="#">Eliminar</a></th>
            </tr>
          <?php
              }
          ?>

        </tbody>
      </table>
    </center>
  </body>
</html>
