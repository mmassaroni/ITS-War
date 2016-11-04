<?php 
	require('juego/fachada/fachada.php');
	session_start();
	//$_SESSION['personajes'] = array();
	$_SESSION['personajes'] = Personajes::instanciar_Personajes_Habilidades();
	//die($_SESSION['personajes']->getpersonajes()[0]->getnombre());
	$_SESSION['objUsu']->setpersonajes(Personajes::personajesDelUsuario($_SESSION['objUsu'], $_SESSION['personajes']));
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
		<link href="https://fonts.googleapis.com/css?family=Indie+Flower|Luckiest+Guy|Righteous|Open+Sans" rel="stylesheet">
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
<style>	
	<?php if ($_GET['tab'] == 1 ) {echo "
		@-webkit-keyframes mostrarTablero {
	    from {background-color: rgba(0,0,0,0.8);}
	    to {background-color: rgba(0,0,0,0);}
		}

		@keyframes mostrarTablero {
		    from {background-color: rgba(0,0,0,0.8);}
		    to {background-color: rgba(0,0,0,0);}
		}
	";} ?>	
</style>
	</head>
	<body><!-- onbeforeunload="desconectar()" -->
		<ul class="topnav" id="myTopnav">
		  <li class="usuario ex"><?php echo $_SESSION['objUsu']->getnombre(); ?></li>
		  <li><a href="game.php?accion=salir">SALIR</a></li>
		  <li><a href="#tienda">TIENDA</a></li>
		  <li class="ex">PESOS $<?php echo $_SESSION['objUsu']->getplata(); ?></li>
		  <li class="icon">
		    <a href="javascript:void(0);" onclick="myFunction()">≡</a>
		  </li>
		</ul>

		<div id="juego">	
			<div class="row">
				
				<div id="panel1" class="panel">
					<?php if ($_GET['tab'] == null) {echo "<img src='/images/mrBean.gif' style='margin-top: 20%'><img src='/images/loading.gif' style='width: 105px;'>";}else{require('juego/generador/panel_iz.php');}?>
				</div><!--cierre panel1-->
				
				<div id="tablero">
					<div id="contPlay" <?php if ($_GET['tab'] == 1 ) {echo "style='background-color: rgba(0,0,0,0)'";} ?>><a href="game.php?accion=eligiendo" id="myBtn" <?php if ($_GET['accion'] != null) {echo "style=display:none";} ?>><img src="/images/Btn_play.png" id="Btn_play"></a></div>
					
					<!-- The Modal -->
					<div id="myModal" class="modal">

						<!-- Modal content -->
						<div class="modal-content">
						    <div class="modal-header">
						      <span class="close">×</span>
						      <h2>Elige un personaje</h2>
						    </div>
							<?php 
								foreach(($_SESSION['objUsu']->getpersonajes()->getpersonajes()) as $personaje){
									echo 
									"<div class='modal-body'>
										<h3>". $personaje->getnombre() ."</h3>
										<a href='game.php?&accion=buscando&tab=1&personaje=". $personaje->getid() ."'>Elegir este</a>
									</div>";
								}
							?>
						</div>
					</div>
				</div><!--cierre tablero-->
				
				<div id="panel2" class="panel">
					<?php if ($_GET['tab'] == null) {echo "<img src='/images/baila2.gif' style='margin-top: 34%'><img src='/images/loading.gif' style='width: 105px; margin-top: 27px;'>";}else{require('juego/generador/panel_d.php');}?>
				</div><!--cierre panel2-->

			</div>

			<div class="row">
				
				<div id="panel3">
					<?php if ($_GET['tab'] == null) {echo "<img src='/images/bob.gif' style='width:160px'>";}else{require('juego/generador/panel_3.php');}?>					
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

			<?php if ($_GET['accion'] == "endo") {echo "mostrarPersonajes();";} ?>

			// When the user clicks on <span> (x), close the modal
			span.onclick = function() {
			    window.location="game.php";
			}

			// Hace una transicion de opacidad
			function mostrarTablero() {
				myBtn.style.backgroundColor = "rgba(0,0,0,0)";
			}

			// MENU
			function myFunction() {
			    var x = document.getElementById("myTopnav");
			    if (x.className === "topnav") {
			        x.className += " responsive";
			    } else {
			        x.className = "topnav";
			    }
			}


// 			window.onbeforeunload = function(event) {
//     event.returnValue = $.ajax({
//                 url:   'game.php?accion=salir',
//        			});;
// };


// #######################################################
// #                                                     #
// #  FUNCIONES PARA CONTROLAR BARRAS DE VIDA Y ENERGIA  #
// #                                                     #
// #######################################################


			function vida() {
			  var elem = document.getElementById("vida");
			  var width = 100; // porcentage actual sin el "%"
			  var id = setInterval(frame, 30);
			  function frame() {        // ⬇ este es el valor nuevo
			    if (width <= 0 || width == 0) {
			      clearInterval(id);
			      document.getElementById("label_vida").innerHTML = "";
			    } else {
			      width--;
			      elem.style.width = width + "%";
			      document.getElementById("label_vida").innerHTML = width;
			    }
			  }
			}

			function energia() {
			  var elem = document.getElementById("energia");
			  var width = 100; // porcentage actual sin el "%"
			  var id = setInterval(frame, 30);
			  function frame() {        // ⬇ este es el valor nuevo
			    if (width <= 0 || width == 0) {
			      clearInterval(id);
			      document.getElementById("label_energia").innerHTML = "";
			    } else {
			      width--;
			      elem.style.width = width + "%";
			      document.getElementById("label_energia").innerHTML = width;
			    }
			  }
			}



<?php if ($_GET['accion'] == "esperando") { echo '
// ##############################
// #                            #
// #  ESPERANDO - TIMER - AJAX  #
// #                            #
// ##############################

		
		setInterval(turno ,5000);									// repite la funcion "turno()" cada 5s
		function turno(){
			$.ajax({
                url:   "/juego/fachada/fachada.php?caca=1",         // ejecuta la fachada con un valor de $_GET a definir para ejecutar una funcion
        	});
        	$("#panel1").load("juego/generador/panel_iz.php");		// "recarga" el panel de la iz
        	$("#panel2").load("juego/generador/panel_d.php");		// "recarga" el panel de la de
		}
';}?>
		</script>
	</body>
</html>