<html>
<?php session_start (); 
 ?>
    <nav id="menu_hamburguesa">
    <a href="javascript:void(0);" class="icon" onclick="myFunction()"><i class="fa fa-bars"></i></a>
    <ul>
			<li><a href="index.php">Inicio</a></li>
			<li class="dropdown">
				<a href="pago.php" class="dropdown-toggle">Alquileres</a>
				<div class="dropdown-content">
				<a href="alquileres.php #FUTBOL">Futbol 5</a>
				<a href="alquileres.php #BASQUET">Basquet</a>
				<a href="alquileres.php #SALON">Salon</a>
				</div>
			</li>
			<li><a href="deportes.php">Deportes</a></li>
			<li><a href="contacto.php">Contacto</a></li>
			<?php
			if (!empty($_SESSION['VARIABLE'])){
				echo '<li><a href="administracion.php">Administracion</a></li>';
                echo '<li><a href="cerrar_sesion.php">Cerrar Sesion</a></li>';
            }
			else{
			echo '<li><a href="iniciar_sesion.php">Iniciar Sesion</a></li>';
			}
		    ?>
        </ul>
    </nav>
</html>