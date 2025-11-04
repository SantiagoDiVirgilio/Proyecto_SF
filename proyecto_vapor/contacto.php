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
    <img class="fondo" src="images/fondo_formu.jpg" alt="">

 <header>
    <?php
    include("NAV.php");
    ?>
</header>

<article >
    <section class="formu">
        <h3>CONTACTO</h3><br>
        <p>¿Quiere hacer algún comentario en cuanto a nuestra página web?<br>
                  ¡Todos sus mensajes son bienvenidos!<br>
            ¡Complete el formulario y envíelo!
        </p>
        <form action="contacto.php" method="post">
            <br><label for="nom">Nombre:</label>
            <input class="input_formu" type="text" name="nombre" maxlength="20" id="identificador"; width:150px>
            <br>
            <br><label for="email">Email:</label>
            <input class="input_formu" type="email" name="email" maxlength="40" id="identificador"; width:150px>
            <br>
            <br><label for="comentario">Haga su comentario <strong>aquí:</strong></label><br><br>
            <textarea class="input_formu" arows="400" cols="60" maxlength="700" style="width: 645px; height: 128px;" name="comentario"> 
            </textarea>
            <br>
            <br><input type="submit" value="Enviar" id="identificador">
            <input type="reset" value="Resetear Información" id="identificador">
        </form>
    </section>
</article>
<br><br><br><br><br>
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