<?php
session_start();
include("conexion.php");
include("socios.php"); // Incluimos la clase Socios
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<link rel="icon" href="imagenes/favicon.webp" type="image/webp">
	<title>Sistema de Gestion de Sociedad de Fomento</title>
	<meta charset="UTF-8">
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap');
	</style>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>

<body>
	<header>
		<a href="index.php"><img src="imagenes/logo.webp" alt="Logo de la página" class="logo"></a>
	
	    <?php
	    include("NAV.php");

        // Creamos una instancia de la clase Socios
	    $socioManager = new Socios($conexion);
        // Obtenemos la lista de socios
	    $lista_socios = $socioManager->getListSocios();
	    ?>
	
	    <?php
	    if (isset($_SESSION['mensaje'])) {
	        echo '<div class="message">' . $_SESSION['mensaje'] . '</div>';
	        unset($_SESSION['mensaje']);
	    }
	    ?>
		<div class="mobile-header-bar">	<a href="javascript:void(0);" class="icon" onclick="toggleMenu()">&#9776;</a>
	</header>

	<div class="tablas">
		<article id="tab1">
            <h2>Listado de Socios</h2>
            <table>
                <thead>
                    <th class="tabla-usuario">Nombre</th>
                    <th class="tabla-usuario">DNI</th>
                    <th class="tabla-usuario">Email</th>
                    <th class="tabla-usuario">Estado</th>
                    <th class="tabla-deporte">Acciones</th>
                </thead>
                <?php foreach($lista_socios as $socio): ?>
                <tr>
                    <td class="tabla-usuario"><?php echo htmlspecialchars($socio["nombre"]);?></td>
                    <td class="tabla-usuario"><?php echo htmlspecialchars($socio["dni"]);?></td>
                    <td class="tabla-usuario"><?php echo htmlspecialchars($socio["email"]);?></td>
                    <td class="tabla-usuario"><?php echo htmlspecialchars($socio["estado"]);?></td>
                    <td>
                        <a class="btn-editar-deporte" href="modificar_usuario_formu.php?id_usuario=<?php echo $socio["id_usuario"];?>">Modificar</a> 
                    </td>
                </tr>
                <?php endforeach; //en modificar tendria que ir para ver las cuotas pagas.?>
            </table>
		</article>
    </div>

<footer>
<?php
    include("FOOTER.php");
?>
</footer>

</body>
</html>