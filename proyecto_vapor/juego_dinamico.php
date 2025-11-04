<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="icon" href="images/Vapor_Logo_Png.png" type="Images/png">
    <title>Vapor: The Proyect</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/estilo_santi.css">
</head>

<body>

<header>
    <?php
    include("NAV.php");
    ?>
</header>



<?php
	include("conexion.php");
	$_SESSION['VARIABLE'] = session_id();

$id = $_GET['ID'];
$resultado_1 = mysqli_query($conexion, "SELECT * FROM juegos WHERE ID = '$id'");
$variable_1 = mysqli_fetch_array($resultado_1);

$id_d = $variable_1["codigo_desarrollador"];
$resultado_2 = mysqli_query($conexion, "SELECT * FROM desarrollador WHERE id='$id_d'");
$variable_2 = mysqli_fetch_array($resultado_2);


$id_e = $variable_1["codigo_editor"];
$resultado_3 = mysqli_query($conexion, "SELECT * FROM editor WHERE id='$id_e'");
$variable_3 = mysqli_fetch_array($resultado_3);

?>


 <h2 class = "titulos"><?php echo $variable_1["Nombre"]; ?></h2>

<article class="juegos">
    <div class="galeria">
    <ul class="slider">
    <li id="slide1"><img src="<?php echo $variable_1['Ruta_Imagenes'].'_1.jpg'; ?>"></li>
    <li id="slide2"><img src="<?php echo $variable_1['Ruta_Imagenes'].'_2.jpg'; ?>"></li>
    <li id="slide3"><img src="<?php echo $variable_1['Ruta_Imagenes'].'_3.jpg'; ?>"></li>
    <li id="slide4"><img src="<?php echo $variable_1['Ruta_Imagenes'].'_4.jpg'; ?>"></li>
    <li id="slide5"><img src="<?php echo $variable_1['Ruta_Imagenes'].'_5.jpg'; ?>"></li>
    <li id="slide6"><img src="<?php echo $variable_1['Ruta_Imagenes'].'_6.jpg'; ?>"></li>
    <li id="slide7"><img src="<?php echo $variable_1['Ruta_Imagenes'].'_7.jpg'; ?>"></li>
    <li id="slide8"><img src="<?php echo $variable_1['Ruta_Imagenes'].'_8.jpg'; ?>"></li>
    <li id="slide9"><img src="<?php echo $variable_1['Ruta_Imagenes'].'_9.jpg'; ?>"></li>
    <li id="slide10"><img src="<?php echo $variable_1['Ruta_Imagenes'].'_10.jpg'; ?>"></li>
    <li id="slide11"><img src="<?php echo $variable_1['Ruta_Imagenes'].'_11.jpg'; ?>"></li>
    <li id="slide12"><img src="<?php echo $variable_1['Ruta_Imagenes'].'_12.jpg'; ?>"></li>
    <li id="slide13"><img src="<?php echo $variable_1['Ruta_Imagenes'].'_13.jpg'; ?>"></li>
 </ul>

 <nav class = "navsl">
    <ul class="galeriasl">
        <li><a href="#slide1">○</a></li>  <!--ES UN SIMBOLO DE UN CIRCULO "○" -->
        <li><a href="#slide2">○</a></li>
        <li><a href="#slide3">○</a></li>
        <li><a href="#slide4">○</a></li>
        <li><a href="#slide5">○</a></li>
        <li><a href="#slide6">○</a></li>
        <li><a href="#slide7">○</a></li>
        <li><a href="#slide8">○</a></li>
        <li><a href="#slide9">○</a></li>
        <li><a href="#slide10">○</a></li>
        <li><a href="#slide11">○</a></li>
        <li><a href="#slide12">○</a></li>
        <li><a href="#slide13">○</a></li>
    </ul>
</nav>
</div>

    <div>
        <img src="<?php echo $variable_1['Ruta_Imagenes'].'_Portada.jpg'; ?>"> 
        <p><?php echo $variable_1["Descripcion_Chica"]?></p>
        <br>
        <h4>FECHA DE LANZAMIENTO: <?php echo $variable_1["Lanzamiento"]; ?>
        <br>
        <br>
        DESARROLLADOR: <?php echo $variable_2["Desarrollador"]; ?>
        <br>
        EDITOR: <?php echo $variable_3["Editor"]; ?>
        </h4>
    </div>

</article>

<div class= "acerca_de">
<h3>ACERCA DE ESTE JUEGO</h3>
<br>
<br>
<p><?php echo $variable_1["Descripcion_Grande"]?></p>
</div>

<div class= "acerca_de">
<h3>REQUISITOS DEL JUEGO</h3>
<br>
<br>
<p><?php echo $variable_1["Requisitos"]?></p>
</div>


<footer>
<?php
    include("FOOTER.php");
    ?>
</footer>

<script type="text/javascript">
    function myFunction() {
      var x = document.getElementById("menu_hamburguesa");
      if (x.className === "") {
          x.className = "responsive";
        } 
      else {
          x.className = "";
        }
    }
</script>
</body>

</html>