<?php 
require('juego/usuario.php');
session_start();
$usuarioLocal = $_SESSION['objUsu'];

$usuarioLocal->setestado("conectado");
$usuarioLocal->actualizar();
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
		<script src='http://cdnjs.cloudflare.com/ajax/libs/less.js/1.3.3/less.min.js'></script>
		<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>

		<script type="text/javascript">
			function salir(){
				var salir = 1;
			
				</script><?php
					$salir = "<script> document.write(salir) </script>";
					
					//if ($salir == 1){
						// echo "aaa";
						// header("Location:index.html");
						// $usuarioLocal->setestado("desconectado");
						// $usuarioLocal->actualizar();
						// session_destroy();
					//}
				?><script>
				salir = 0;
			}

			$(function () {
		    	// Ubico el tablero en la pantalla
		        var elemento = $("#tablero");
				var posicion = elemento.position();

			    // funcion que obtiene el valor entero de una propiedad css
			    function getNumericStyleProperty(style, prop){
			        return parseInt(style.getPropertyValue(prop),10);
			    }

			    // evitamos redibujar al clickear sobre un punto ya existente
			    $('#tablero').on('click', '.punto', function(e){
			        e.stopPropagation();
			        return false;
			    })

			    $('#tablero').click(function(ev){
			        if(ev.offsetX == undefined) // para firefox
			        {
			            x = ev.pageX- $(this).offset().left;
			            y = ev.pageY-$(this).offset().top;
			        }
			        else // chrome
			        {
			            x = ev.offsetX;
			            y = ev.offsetY;
			        }

			       
			        // Tomando posicion en el tablero
			        // Considerando bordes
			        var style = getComputedStyle(this,null) ;
			        var borderTop = getNumericStyleProperty(style,"border-top-width") ;
			        var borderLeft = getNumericStyleProperty(style,"border-left-width") ;
			        y += borderTop + posicion.top ;
			        x += borderLeft + posicion.left ;
			        // console.log('x,y : ' + x + ',' + y);

			        
			        // Tomando posicion sin el tablero
			        var x_ = ev.pageX - this.offsetLeft;
			        var y_ = ev.pageY - this.offsetTop;
			        // considerando bordes
			        y_ += borderTop ;
			        x_ += borderLeft ;
			        // console.log('x_,y_ : ' + x_ + ',' + y_);

			        
			        alert("x-: " + x_ + " y-: " + y_ + " x+: " + x + " y+: " + y);
			    });
			});

			//function jugar(){
			//	var jugar=1;
			//	<?php
			//		if (document.write(jugar) == 1){
			//			$usuarioLocal->setestado("buscando");
			//			$usuarioLocal->actualizar();
			//		}
			//	?>
			//};


</script>	
	</head>
	<body>
	<a href="#"><?php echo $salir; ?></a>
		<div id="menu">
			<ul>
				<li class="usuario"><?php echo $usuarioLocal->getnombre(); ?></li>
				<a href="#" onclick="salir();"><li>SALIR</li></a>
				<a href="#"><li>TIENDA</li></a>
				<li>PESOS $<?php echo $usuarioLocal->getplata(); ?></li>	
			</ul>
		</div> <!-- cierre menu -->	
		<div id="juego">	
			<div class="row">
				
				<div id="panel1" class="panel">
					<div class="j1">
						<h1><?php echo $usuarioLocal->getnombre(); ?></h1>
					</div>

					<div class="j2">
						
					</div>
				</div><!--cierre panel1-->
				
				<div id="tablero">
				<!-- <img src="images/tablero.jpg" class="imgTablero"> -->
				<a href="#" onclick="jugar()">► PLAY</a>
				</div><!--cierre tablero-->
				
				<div id="panel2" class="panel">
				</div><!--cierre panel2-->

			</div>

			<div class="row">
				
				<div id="panel3">

				</div><!-- cierre panel3 -->

			</div>
		</div><!--cierre juego-->
	</body>
</html>
