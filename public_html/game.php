<?php 
	require('juego/fachada/fachada.php');
	session_start();
	$_SESSION['personajes'] = array();
	$_SESSION['personajes'] = instanciar_Personajes_Habilidades();
	
	estados($_SESSION['objUsu']);
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
		<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

		<script type="text/javascript">
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

			        
			        //alert("x-: " + x_ + " y-: " + y_ + " x+: " + x + " y+: " + y);
			    });
			});
</script>	
	</head>
	<body>
		<div id="menu">
			<ul>
				<li class="usuario"><?php echo $_SESSION['objUsu']->getnombre(); ?></li>
				<a href="game.php?accion=3"><li>SALIR</li></a>
				<a href="#"><li>TIENDA</li></a>
				<li>PESOS $<?php echo $_SESSION['objUsu']->getplata(); ?></li>	
			</ul>
		</div> <!-- cierre menu -->	
		<div id="juego">	
			<div class="row">
				
				<div id="panel1" class="panel">
					<div class="j1">
						<h1><?php echo $_SESSION['objUsu']->getnombre(); ?></h1>
						<div class="row">
							<div class="img-per"><img src="" title=""></div>
							<div class="valores-per">
								<h2>VIDA</h2><img src="">
								<h2>FUERZA</h2><img src="">
								<h2>ENERGÍA</h2><img src="">
								<h2>RESISTENCIA</h2><img src="">
							</div>
						</div>
					</div>
					<hr/>
					<div class="j2">
						<h1><!-- Nombre del jugador --></h1>
						<div class="row">
							<div class="img-per"><img src="" title=""></div>
							<div class="valores-per">
								<h2>VIDA</h2><img src="" title="">
								<h2>FUERZA</h2><img src="" title="">
								<h2>ENERGÍA</h2><img src="" title="">
								<h2>RESISTENCIA</h2><img src="" title="">
							</div>
						</div>
					</div>
				</div><!--cierre panel1-->
				
				<div id="tablero">
					<a href="game.php?accion=1" id="myBtn"><img src="/images/Btn_play.png" id="Btn_play"></a>
					<!-- The Modal -->
					<div id="myModal" class="modal">

					  <!-- Modal content -->
					  <div class="modal-content">
					    <div class="modal-header">
					      <span class="close">×</span>
					      <h2>Elige un personaje</h2>
					    </div>
					    <div class="modal-body">
					      <!-- Acá van los personajes del cliente -->
					    </div>
					  </div>

					</div>
				</div><!--cierre tablero-->
				
				<div id="panel2" class="panel">
					<div class="j3">
						<h1><!-- Nombre del jugador --></h1>
						<div class="row">
							<div class="img-per"><img src="" title=""></div>
							<div class="valores-per">
								<h2>VIDA</h2><img src="">
								<h2>FUERZA</h2><img src="">
								<h2>ENERGÍA</h2><img src="">
								<h2>RESISTENCIA</h2><img src="">
							</div>
						</div>
					</div>
					<hr/>
					<div class="j4">
						<h1><!-- Nombre del jugador --></h1>
						<div class="row">
							<div class="img-per"><img src="" title=""></div>
							<div class="valores-per">
								<h2>VIDA</h2><img src="" title="">
								<h2>FUERZA</h2><img src="" title="">
								<h2>ENERGÍA</h2><img src="" title="">
								<h2>RESISTENCIA</h2><img src="" title="">
							</div>
						</div>
					</div>
				</div><!--cierre panel2-->

			</div>

			<div class="row">
				
				<div id="panel3">

				</div><!-- cierre panel3 -->

			</div>
		</div><!--cierre juego-->
		<script type="text/javascript">
			// Get the modal
			var modal = document.getElementById('myModal');

			// Get the button that opens the modal
			var btn = document.getElementById("myBtn");
			var btn_play = document.getElementById("Btn_play");

			// Get the <span> element that closes the modal
			var span = document.getElementsByClassName("close")[0];

			// When the user clicks the button, open the modal
			function mostrarPersonajes() {
				btn_play.style.display = "none";
			    modal.style.display = "block";
			}
			
			<?php if ($_GET['accion'] == 1) {echo "mostrarPersonajes();";} ?>

			// When the user clicks on <span> (x), close the modal
			span.onclick = function() {
			    window.location="game.php";
			}

			// When the user clicks anywhere outside of the modal, close it
			window.onclick = function(event) {
			    window.location="game.php";
			}

			// Hace una transicion de opacidad
			function mostrarTablero() {
				myBtn.style.backgroundColor = "rgba(0,0,0,0)";
			}
		</script>
	</body>
</html>
