<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="icon" href="images/Vapor_Logo_Png.png" type="Images/png">
    <title>Vapor: The Proyect</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/estilo_santi.css">
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
      integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
</head>

<body>
<header>
    <?php
    include("NAV.php");
    ?>
</header>


<?php
   include("conexion.php");


   $resultado_2 = mysqli_query($conexion, "SELECT * FROM generos");
 ?>

<?php 
    if ($_SESSION["VARIABLE"] == session_id()){?>
        
        
<div class="cajabuscar"><form method="get" id="buscarform" action="resultados_buscar.php">
    <fieldset>
        <input type="search" id="s" name="buscar" placeholder="Buscar..." required />
        <input class="button" type="submit" value="" >
        <i class="search"></i>
    </fieldset>
    </form></div>


    <?php while($variable_2 = mysqli_fetch_assoc($resultado_2)){?>
        <section class="generos" id="<?php echo $variable_2["genero"]; ?>">
            <h2><?php echo $variable_2["genero"]; ?></h2>

            <?php $resultado_1 = mysqli_query($conexion, "SELECT * FROM juegos"); ?>
            <?php while($variable_1 = mysqli_fetch_assoc($resultado_1)){?>
            
                <?php if($variable_1["codigo_genero"] == $variable_2["id"]){?>
                    <div>
                        <a href="juego_dinamico.php?ID=<?php echo $variable_1["ID"];?>"><img src="<?php echo $variable_1['Ruta_Imagenes'].'_Portada.jpg'; ?>"  class="zoom"></a>
                        <h3><?php echo $variable_1["Nombre"]; ?></h3>
                    </div>
                <?php }?>
                <?php }?>
        </section>
                
            <?php }?>
    <?php    
}else {
    header("Location:iniciar_sesion.php");
}

?>

<footer>
<?php
    include("FOOTER.php");
    ?>
</footer>

<script type="text/javascript"> <!-- Funcion menu hamburguesa -->
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


<!-- Script de efecto zoom -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

<script>
$(document).ready(function(){
    $('.zoom').hover(function() {
        $(this).addClass('transition');
    }, function() {
        $(this).removeClass('transition');
    });
});
</script>
</body>

</html>