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

<article>
    <?php
   include("conexion.php");
   $id=$_SESSION['ID'];

    $consulta=mysqli_query($conexion, "SELECT * FROM usuarios WHERE id='$id'");

    $resultado=mysqli_fetch_assoc($consulta);

    $resultado_1 = mysqli_query($conexion, "SELECT * FROM juegos");
    ?>
</article>

<article class="perfil">
        <h2> Nombre: <?php echo $_SESSION['NOMBRE']; ?>
         <br>Apellido: <?php echo $_SESSION['APELLIDO']; ?> 
         <br>Nombre de Usuario: <?php echo $_SESSION['USUARIO']; ?>
         <br>Mail: <?php echo $_SESSION['MAIL']; ?>
         <br><a href="modificar_usuario_formu.php?ID=<?php echo $resultado["id"];?>">Editar</a>
         </h2>

</article>

  <?php 
    if ($_SESSION['NIVEL'] == 1){?>
        <h3 class="perfil"> <br><br>TIPO DE PERFIL: ADMINISTRADOR<br> </h3>
<div class="wrap">
		<ul class="tabs">
			<li><a href="#tab1"><span class="fa fa-gamepad"></span><span class="tab-text">Juegos</span></a></li>
			<li><a href="#tab2"><span class="fa fa-tags"></span><span class="tab-text">Generos</span></a></li>
			<li><a href="#tab3"><span class="fa fa-file-code-o"></span><span class="tab-text">Desarrolladores</span></a></li>
			<li><a href="#tab4"><span class="fa fa-suitcase"></span><span class="tab-text">Editores</span></a></li>
		</ul>

		<div class="secciones">
			<article id="tab1">
            <table>
                    <thead>
                    </thead>
                    <tr>
                        <td style="text-align: center;"><a href="añadir_juego_formu.php?ID=<?php echo $variable_1["ID"];?>">AÑADIR NUEVO</a></td>
                    </tr>
                </table>

                <table>
                    <thead>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Genero</th>
                        <th>Desarrollador</th>
                        <th>Editor</th>
                        <th>Lanzamiento</th>
                        <th>Descripcion_Chica</th>
                        <th>Descripcion_Grande</th>
                        <th>Requisitos</th>
                        <th>Ruta_Imagenes</th>
                        <th>Opciones</th>
                    </thead>
                    <?php while($variable_1 = mysqli_fetch_assoc($resultado_1)){?>
                    <tr>
                        <td><?php echo $variable_1["ID"];?></td>
                        <td><?php echo $variable_1["Nombre"];?></td>

                        <?php $id_g = $variable_1["codigo_genero"];
                        $resultado_2 = mysqli_query($conexion, "SELECT * FROM generos WHERE id='$id_g'");
                        $variable_2 = mysqli_fetch_array($resultado_2);?>
                        <td><?php echo $variable_2["genero"];?></td>


                        <?php $id_d = $variable_1["codigo_desarrollador"];
                        $resultado_3 = mysqli_query($conexion, "SELECT * FROM desarrollador WHERE ID='$id_d'");
                        $variable_3 = mysqli_fetch_array($resultado_3);?>
                        <td><?php echo $variable_3["Desarrollador"];?></td>


                        <?php $id_e = $variable_1["codigo_editor"];
                        $resultado_4 = mysqli_query($conexion, "SELECT * FROM editor WHERE ID='$id_e'");
                        $variable_4 = mysqli_fetch_array($resultado_4);?>
                        <td><?php echo $variable_4["Editor"];?></td>



                        <td><?php echo $variable_1["Lanzamiento"];?></td>
                        <td><?php echo $variable_1["Descripcion_Chica"];?></td>
                        <td><?php echo $variable_1["Descripcion_Grande"];?></td>
                        <td><?php echo $variable_1["Requisitos"];?></td>
                        <td><?php echo $variable_1["Ruta_Imagenes"];?></td>
                        <td>
                            <a  href="modificar_formu.php?ID=<?php echo $variable_1["ID"];?>">Editar</a><br><br><br>
                            <a  href="borrar.php?ID=<?php echo $variable_1["ID"];?>">Borrar</a>
                        </td>

                    </tr>
                    <?php }?>
                </table>
			</article>

			<article id="tab2">
                <table>
                    <thead>
                    </thead>
                    <tr>
                        <td style="text-align: center;"><a href="añadir_genero_formu.php">AÑADIR NUEVO</a></td>
                    </tr>
                </table>

                 <table> 
                    <thead>
                        <th>ID</th>
                        <th>Genero</th>
                    </thead>
                    <?php $resultado_2 = mysqli_query($conexion, "SELECT * FROM generos");?>
                    <?php while($variable_2 = mysqli_fetch_assoc($resultado_2)){?>
                    <tr>
                        <td><?php echo $variable_2["id"];?></td>
                        <td><?php echo $variable_2["genero"];?></td>
                    </tr>
                    <?php }?>
                </table>		
	        </article>

			<article id="tab3">
                <table>
                    <thead>
                    </thead>
                    <tr>
                        <td style="text-align: center;"><a href="añadir_desarrollador_formu.php?ID=<?php echo $variable_3["ID"];?>">AÑADIR NUEVO</a></td>
                    </tr>
                </table>


                <table>
                    <thead>
                        <th>ID</th>
                        <th>Desarrollador</th>
                    </thead>
                    <?php $resultado_3 = mysqli_query($conexion, "SELECT * FROM desarrollador");?>
                    <?php while($variable_3 = mysqli_fetch_assoc($resultado_3)){?>
                    <tr>
                        <td><?php echo $variable_3["ID"];?></td>
                        <td><?php echo $variable_3["Desarrollador"];?></td>
                    </tr>
                    <?php }?>
                </table>	
		    </article>

			<article id="tab4">
                <table>
                    <thead>
                    </thead>
                    <tr>
                        <td style="text-align: center;"><a href="añadir_editor_formu.php?ID=<?php echo $variable_4["ID"];?>">AÑADIR NUEVO</a></td>
                    </tr>
                </table>

                <table>
                    <thead>
                        <th>ID</th>
                        <th>Editor</th>
                    </thead>
                    <?php $resultado_4 = mysqli_query($conexion, "SELECT * FROM editor");?>
                    <?php while($variable_4 = mysqli_fetch_assoc($resultado_4)){?>
                    <tr>
                        <td><?php echo $variable_4["ID"];?></td>
                        <td><?php echo $variable_4["Editor"];?></td>
                    </tr>
                    <?php }?>
                </table>	
			</article>

		</div>
	</div>

<?php } else{?>
        <h3 class="perfil"> <br><br>TIPO DE PERFIL: SUSCRIPTOR<br> </h3>

<?php } ?>

<article>
<a class="boton_cerrar" href="cerrar_sesion.php">Cerrar Sesión</a>
</article>

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

<script>

$('ul.tabs li a:first').addClass('active');
	$('.secciones article').hide();
	$('.secciones article:first').show();

	$('ul.tabs li a').click(function(){
		$('ul.tabs li a').removeClass('active');
		$(this).addClass('active');
		$('.secciones article').hide();

		var activeTab = $(this).attr('href');
		$(activeTab).show();
		return false;
	});
</script>
?>
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