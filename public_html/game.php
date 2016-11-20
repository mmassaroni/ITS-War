<?php 
	require_once('juego/fachada/fachada.php');
	session_start();
	$_SESSION['personajes'] = Personajes::instanciar_Personajes_Habilidades();
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
			// Habilita el ajax para tomar las coordenadas con valor 1
			var tomarXY = 0;
			var accion = "posicionamiento";

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
			        //y += borderTop + posicion.top ;
			        //x += borderLeft + posicion.left ;
			        // console.log('x,y : ' + x + ',' + y);

			        
			        // Tomando posicion sin el tablero
			        var x = ev.pageX - this.offsetLeft;
			        var y = ev.pageY - this.offsetTop;
			        // considerando bordes
			        //y += borderTop ;
			        //x += borderLeft ;
			        // console.log('x_,y_ : ' + x_ + ',' + y_);

			        
			        //alert("x-: " + x_ + " y-: " + y_ + " x+: " + x + " y+: " + y);

			        if (tomarXY == 1) {
			        	tomarXY = 0;
			        	function mover(){
			        		$.ajax({
				        		data: { coordenadaX: x, coordenadaY: y },
								type: "POST",
						        url: "juego/fachada/mover.php",
						        success: function () { 
						        	document.getElementById("tablero").style.cursor = "auto";
						        	$("#tablero").load("juego/generador/tablero.php?accion=jugando");
						        	if (accion == "posicionamiento") {
						        		controlPosicion();	
						        	}else if (accion == "mover"){
						        		jugar();
						        	}
						        	
								}
							});
			        	}
			        	mover();
			        }
			    });
			});


			<?php

				if ($_GET['accion'] == "esperando") { 
					
					echo 'function cargarPanelesPrimeraVez(){
							$("#panel1").load("juego/generador/panel_iz.php"); 
				        	$("#panel2").load("juego/generador/panel_d.php?accion='.$_GET['accion'].'"); 		        	
						}';

					echo '
						// ##############################
						// #                            #
						// #  ESPERANDO - TIMER - AJAX  #
						// #                            #
						// ##############################

						var intervalo = setInterval(
							function loadpaneles(){
				        	$("#panel1").load("juego/generador/panel_iz.php"); 
				        	$("#panel2").load("juego/generador/panel_d.php?accion='.$_GET['accion'].'");
						}, 5000);';
				}

				if ($_GET['accion'] == "jugando") { 
					
					echo 'function cargarPanelesPrimeraVezJugando(){
							$("#panel1").load("juego/generador/panel_iz.php"); 
				        	$("#panel2").load("juego/generador/panel_d.php?accion='.$_GET['accion'].'");
				        	$("#tablero").load("juego/generador/tablero.php?accion='.$_GET['accion'].'");
						}
						';

					echo '

						alert("Es momento de elegir las posiciones. Espera tu turno.");

						function controlPosicion () {
							var posicionarte = setInterval(function turno(){
								$.ajax({
									data: { accion : "miTurno" },
									type: "POST",
							        url: "juego/fachada/turno.php",
							        dataType: "json",
							        success: function (respuesta) { 
							        	if (respuesta[0] == 1 && respuesta[1] < 4) {
							        		clearInterval(posicionarte);
							        		$("#tablero").load("juego/generador/tablero.php?accion=jugando");
							        		$("#panel1").load("juego/generador/panel_iz.php"); 
					        				$("#panel2").load("juego/generador/panel_d.php?accion=jugando"); 
							        		alert("Elige tu posicion inicial en el tablero.");
							        		document.getElementById("tablero").style.cursor = "crosshair";
											tomarXY = 1;
							        	} else {
							        		$("#tablero").load("juego/generador/tablero.php?accion=jugando");
							        		$("#panel1").load("juego/generador/panel_iz.php"); 
					        				$("#panel2").load("juego/generador/panel_d.php?accion=jugando"); 
							        	}

							        	if (respuesta[1] == 4) { 
							        		clearInterval(posicionarte);
							        		alert("¡Comienza la partida!"); 
							        		accion = "mover";
							        		jugar();
							        	}
									}
								})}
							, 5000);
						} if (accion == "posicionamiento"){controlPosicion();}';

					echo 'function jugar() {
							var jugar = setInterval(function jugarTurno(){
								$.ajax({
									data: { accion : "miTurno" },
									type: "POST",
							        url: "juego/fachada/turno.php",
							        dataType: "json",
							        success: function (respuesta) { 
							        	if (respuesta[0] == 1) {
							        		clearInterval(jugar);
							        		$("#tablero").load("juego/generador/tablero.php?accion=jugando");
							        		$("#panel1").load("juego/generador/panel_iz.php"); 
					        				$("#panel2").load("juego/generador/panel_d.php?accion=jugando"); 
							        		document.getElementById("tablero").style.cursor = "crosshair";
											
							        	} else {
							        		$("#tablero").load("juego/generador/tablero.php?accion=jugando");
							        		$("#panel1").load("juego/generador/panel_iz.php"); 
					        				$("#panel2").load("juego/generador/panel_d.php?accion=jugando"); 
							        	}
									}
								})}
							, 5000);
						}';

					echo 'function pasar() {
						$.ajax({
							data: { accion : "pasar" },
							type: "POST",
					        url: "juego/fachada/turno.php",
					        success: function (respuesta) { 
				        		$("#panel1").load("juego/generador/panel_iz.php"); 
		        				$("#panel2").load("juego/generador/panel_d.php?accion=jugando"); 
							}
						});
					}';
				}

			?>
			
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

			@keyframes rotate {from {transform: rotate(0deg);}
			to {transform: rotate(360deg);}}
			@-webkit-keyframes rotate {from {-webkit-transform: rotate(0deg);}
			to {-webkit-transform: rotate(360deg);}}
		</style>
	</head>
	<body <?php if ($_GET['accion'] == "esperando") { echo 'onload="cargarPanelesPrimeraVez()"'; }elseif ($_GET['accion'] == "jugando") { echo 'onload="cargarPanelesPrimeraVezJugando()"'; } ?> ><!-- onbeforeunload="desconectar()" -->
		<ul class="topnav" id="myTopnav">
		  <li id="caca" class="usuario ex"><?php echo $_SESSION['objUsu']->getnombre(); ?></li>
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
					<?php if ($_GET['accion'] != "esperando" and $_GET['accion'] != "jugando"){echo "<img src='/images/logo.png' style='-webkit-animation-name: rotate; -webkit-animation-duration: 4s; -webkit-animation-iteration-count: infinite; animation-name: rotate; animation-duration: 4s; animation-iteration-count: infinite; margin-top: 20%'><img src='/images/loading.gif' style='width: 105px;'>";}?>
				</div><!--cierre panel1-->
				
				<div id="tablero" <?php if ($_GET['accion']=='jugando') { echo "style='text-align: left;'";	} ?>>


					<div id="contPlay" 
<?php if ($_GET['tab'] == 1 ) {
	echo "style='background-color: rgba(0,0,0,0)'";
} ?>
><a href=
<?php if ($_GET['accion'] == 'esperando') { 
	echo "'game.php?accion=saliendo'"; 
	} else { 
		echo "'game.php?accion=eligiendo'"; 
	} ?> 
	id="myBtn" 
<?php if ($_GET['accion'] == 'jugando') {
	echo "style=display:none";
	} ?>
	><img src=<?php if ($_GET['accion'] == 'esperando') { 
		echo "'/images/Btn_stop.png'"; 
	} else { 
		echo "'/images/Btn_play.png'"; 
	} ?>
	id="Btn_play"></a>

	</div>
	
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
					<a href='game.php?&accion=buscando&personaje=". $personaje->getid() ."'>Elegir este</a>
				</div>";
			}
		?>
	</div>
</div>

				</div><!--cierre tablero-->
				
				<div id="panel2" class="panel">
					<?php if ($_GET['accion'] != "esperando" and $_GET['accion'] != "jugando"){echo "<img src='/images/mrBean.gif' style='margin-top: 20%'><img src='/images/loading.gif' style='width: 105px;'>";}?>
				</div><!--cierre panel2-->

			</div>

			<div class="row">
				
				<div id="panel3">
					<?php if ($_GET['tab'] == null) {echo "<img src='/images/bob.gif' style='width:160px'>";}else{require_once('juego/generador/panel_3.php');}?>
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

			<?php if ($_GET['accion'] == "eligiendo") {echo "mostrarPersonajes();";} ?>

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




		</script>
	</body>
</html>

