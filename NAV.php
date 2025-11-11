<nav id="myTopnav">
    <a href="javascript:void(0);" class="icon" onclick="toggleMenu()"><i class="fa fa-bars"></i></a>
    <ul>
        <li><a href="index.php">Inicio</a></li>
        <li class="custom-dropdown">
            <a href="pago_reserva.php?id_cancha=1">Alquileres</a>
            <div class="custom-dropdown-content">
                <a href="alquileres.php#FUTBOL">Futbol</a>
                <a href="alquileres.php#BASQUET">Basquet</a>
                <a href="alquileres.php#SALON">Salon</a>
                <a href="alquileres.php#NATACION">Pileta</a>
            </div>
        </li>
        <li><a href="deportes.php">Deportes</a></li>
        <li><a href="contacto.php">Contacto</a></li>
        <?php
        if (!empty($_SESSION['id_usuario'])) {
            if (isset($_SESSION['ROL']) && (strtolower($_SESSION['ROL']) == 'admin')) {
                echo '<li><a href="administracion.php">Administracion</a></li>';
            }
            echo '<li><a href="perfil.php">Perfil</a></li>';
            echo '<li><a href="cerrar_sesion.php">Cerrar Sesion</a></li>';
        } else {
            echo '<li><a href="iniciar_sesion.php">Iniciar Sesion</a></li>';
        }
        ?>
    </ul>
</nav>