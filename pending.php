<?php session_start(); ?><!DOCTYPE html>
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
<style>
        
    </style>

<body>
	<header>
		<a href="index.php"><img src="imagenes/logo.webp" alt="Logo de la página" class="logo"></a>
	
	<?php
    include("NAV.php");
    ?>
    <?php
    // --- AÑADIDO: Lógica para obtener el id_cancha ---
    include("conexion.php");
/*
    $id_cancha = '4'; // Valor por defecto si no se encuentra
    $sql_pago = "INSERT INTO pagos (id_pago) VALUES (null)";
    $stmt_insert = mysqli_prepare($conexion, $sql_pago);
    mysqli_stmt_execute($stmt_insert);
    $id_pago = mysqli_stmt_insert_id($stmt_insert);
    mysqli_stmt_close($stmt_insert);
*/
  

    ?>



<footer>
<?php
    echo "$id_pago";
?>
</footer>
</body>

</html>