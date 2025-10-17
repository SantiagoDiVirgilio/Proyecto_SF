<html>
<?php session_start (); 
 $_SESSION['VARIABLE'] = session_id()
 ?>
    <nav id="menu_hamburguesa">
    <a href="javascript:void(0);" class="icon" onclick="myFunction()"><i class="fa fa-bars"></i></a>
    <ul>
			<li><a href="index.php">Inicio</a></li>
			<li class="dropdown">
				<a>Alquileres</a>
				<div class="dropdown-content">
				<a href="alquileres.php #FUTBOL 5">Futbol 5</a>
				<a href="alquileres.php #BASQUET">Basquet</a>
				<a href="alquileres.php #SALON">Salon</a>
				</div>
			</li>
			<li class="dropdown">
				<a>Inscripciones</a>
				<div class="dropdown-content">
				<a href="inscripcion_1.php">Inscripcion 1</a>
				<a href="inscripcion_2.php">Inscripcion 2</a>
				</div>
			</li>
			<li><a href="contacto.php">Contacto</a></li>
        </ul>
    </nav>
</html>