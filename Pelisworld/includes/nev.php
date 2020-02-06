<nav>
		<span id="logotipo" ><a href="index.php">PelisWorld</a></span>
		<ul class="menu">
			<li><a href="index.php">Inicio</a></li>
			<li><a href="userBuscarpeli.php">Peliculas</a></li>
			<?php if(isset($_SESSION['userId'])){ ?>
			<li><a href="favoritos.php">Favoritos</a></li>
			<?php } ?>
			<li><a href="noticias.php">Nocicias</a></li>
			<?php if(!isset($_SESSION['username'])){ ?>
			<li style="color: #B23E00">
				Sesion
			
			 <ul >		
						
            			<li ><a href="login.php">Log-in</a></li>
                        <li ><a href="registro.php">Sing-up</a></li>

             </ul>
			
			</li>
			<?php }else{ ?>
			<li>
				<?php  echo $_SESSION['username'];?> 
				<ul>
					    <li ><a href="editar.php">Editar Perfil</a></li>
                        <?php  if($_SESSION['userrol'] == 'admin') { ?>
						<li ><a href="cpanel.php">Administrar</a></li>
                        <?php } ?>
                        <li ><a href="?logOut=true">Log-out</a></li>

				</ul>
			</li>
			<?php } ?>
		</ul>
	</nav>