<?php 
require('juego/usuario.php');
session_start();
$usuarioLocal = $_SESSION['objUsu'];

if ($_GET['accion']==null) {
	$usuarioLocal->setestado("conectado");
	$usuarioLocal->actualizar();
}
elseif ($_GET['accion']=="1") {
	$usuarioLocal->setestado("buscando");
	$usuarioLocal->actualizar();
}
elseif ($_GET['accion']=="2") {
	$usuarioLocal->setestado("jugando");
	$usuarioLocal->actualizar();
	session_destroy();
} 
elseif ($_GET['accion']=="3") {
	$usuarioLocal->setestado("desconectado");
	$usuarioLocal->actualizar();
	session_destroy();
	header("location:/");
}

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
				<li class="usuario"><?php echo $usuarioLocal->getnombre(); ?></li>
				<a href="game.php?accion=3"><li>SALIR</li></a>
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
				<a href="game.php?accion=1" id="myBtn"><img src="/images/Btn_play"></a>
				<!-- The Modal -->
				<div id="myModal" class="modal">

				  <!-- Modal content -->
				  <div class="modal-content">
				    <div class="modal-header">
				      <span class="close">×</span>
				      <h2>Modal Header</h2>
				    </div>
				    <div class="modal-body">
				      <p>Some text in the Modal Body</p>
				      <p>Some other text...</p>
				    </div>
				    <div class="modal-body">
				      <p>Some text in the Modal Body</p>
				      <p>Some other text...</p>
				    </div>
				    <div class="modal-footer">
				      <h3>Modal Footer</h3>
				    </div>
				  </div>

				</div>
				</div><!--cierre tablero-->
				
				<div id="panel2" class="panel">
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

			// Get the <span> element that closes the modal
			var span = document.getElementsByClassName("close")[0];

			// When the user clicks the button, open the modal
			function mostrarPersonajes() {
			    modal.style.display = "block";
			}
			
			<?php if ($_GET['accion'] == 1) {echo "mostrarPersonajes();";} ?>

			// When the user clicks on <span> (x), close the modal
			span.onclick = function() {
			    modal.style.display = "none";
			}

			// When the user clicks anywhere outside of the modal, close it
			window.onclick = function(event) {
			    if (event.target == modal) {
			        modal.style.display = "none";
			    }
			}
		</script>
	</body>
</html>
