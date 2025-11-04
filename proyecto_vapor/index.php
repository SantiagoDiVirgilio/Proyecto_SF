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
    <img class="fondo" src="images/fondo_index.jpg" alt="">
    <header>
    <?php
    include("NAV.php");
    ?>
</header>

    <section  class="inicio">
        <article>
            <h1>Vapor</h1>
            <h2>El sitio web más elegido por los jugadores</h2>
        </article>

        <article>
            <p>¡Bienvenido a la sección de inicio de <i>Vapor</i> !. Inicia sesión o crea una cuenta totalmente <i>gratis</i> para disfrutar de todo el contenido que tenemos para ofrecer en nuestro sitio web. Accede a las distintas secciones de juegos, mediante el menú superior, o mediante nuestro árbol de sitio al final de la página.</p> 
        </article>

        <article >
            <h3><u><i>Preguntas Frecuentes:</h3></u></i><br><br>
            <h4>○ ¿Que es <i>"Vapor"</i>?</h4>
                <p><strong><i>Vapor</strong></i> es un sitio web <strong>no oficial</strong>, sin fines de lucro, inspirado en la famosa página de videojuegos <i>"Steam"</i>. Este sitio recopila información sobre múltiples juegos, y los enlista en base a su género. Su única función es la de informar, por lo que no se podrán comprar juegos, ni ningún tipo de artículo relacionado a los mismos.</p> 
            <br>
            <br>
            <h4>○ ¿Cómo puedo contactarme con los desarrolladores?</h4>
                <p>Puede enviar un mensaje sobre la página a nuestros desarrolladores mediante el formulario de contacto, al cuál puede llegar clikeando la sección "Contacto" en el menú de arriba, o mediante nuestro árbol de sitio al final de la página. 
                </p> 
            <br>
            <br>
            <h4>○ ¿Dónde puedo encontrar la página <i>"Steam"</i>?</h4>
                <p>Puede acceder a Steam buscándolo en su navegador predeterminado, o clikeando sobre el logo oficial de la página debajo: <br><a href="https://store.steampowered.com/?l=spanish" target="_blank"><img src="images/Steam_icon.png" alt="Logo página Steam" class="steam" target="_blank"></a>
                </p> 
        </article>  
    </section>
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

<!-- Script de efecto zoom -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

<script>
$(document).ready(function(){
    $('.steam').hover(function() {
        $(this).addClass('transition');
    }, function() {
        $(this).removeClass('transition');
    });
});
</script>
</body>

</html>