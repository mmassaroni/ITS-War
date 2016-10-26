<?php 
require('juego/usuario.php');
session_start();
$usuarioLocal = $_SESSION['objUsu'];
?>

<!DOCTYPE html>
<html>
	<head>
		<title>ITS • WAR</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/juego.css" />
		<link rel="shortcut icon" href="ico.ico">
		<link href="https://fonts.googleapis.com/css?family=Indie+Flower|Luckiest+Guy|Open+Sans" rel="stylesheet">
		<script>
			var elemento = $(".midiv");
			var posicion = elemento.position();
		</script>
	</head>
	<body>
		<div id="menu">
			<ul>
				<li class="usuario"><?php echo $usuarioLocal->getnombre(); ?></li>
				<a href="/"><li>SALIR</li></a>
				<a href="#"><li>TIENDA</li></a>
				<li>PESOS $<?php echo $usuarioLocal->getplata(); ?></li>	
			</ul>
		</div> <!-- cierre menu -->	
		<div id="juego">	
			<div id="panel1" class="panel">
				<div class="j1">
					<h1>MASSA1</h1>
				</div>

				<div class="j2">
					
				</div>
			</div><!--cierre panel1-->
			
			<div id="tablero">
			</div><!--cierre tablero-->
			
			<div id="panel2" class="panel">
			</div><!--cierre panel2-->
		</div><!--cierre juego-->
	</body>
</html>
