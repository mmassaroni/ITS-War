<?php 
require('juego/fachada/fachada.php');
session_start();
//if (empty($_SESSION['objUsu'])){
	if ($_GET['log']==1) {
		$_SESSION['objUsu'] = Usuarios::login($_REQUEST['usu_email'], $_REQUEST['pass']);
		header('Location:game.php');
	} elseif ($_GET['make']==1) {
		$_SESSION['objUsu'] = Usuarios::registro($_REQUEST['usu'], $_REQUEST['email'], $_REQUEST['pass']);
		header("Location:game.php");
	}
// }else{
// 	die("Ya tiene una sesión iniciada");
// }


?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>ITS • WAR - Login</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" type="text/css" href="assets/css/login.css" />
		<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
		<link rel="shortcut icon" href="ico.ico">
		<style>
			/* The Modal (background) */
			.modal {
			    display: <?php if ($_GET['error']==1 or $_GET['error']==2){echo "block";}else{echo "none";}?>; /* Hidden by default */
			    position: fixed; /* Stay in place */
			    z-index: 2; /* Sit on top */
			    padding-top: 100px; /* Location of the box */
			    left: 0;
			    top: 0;
			    width: 100%; /* Full width */
			    height: 100%; /* Full height */
			    overflow: auto; /* Enable scroll if needed */
			    background-color: rgb(0,0,0); /* Fallback color */
			    background-color: rgba(0,0,0,0.6); /* Black w/ opacity */
			}

			/* Modal Content */
			.modal-content {
			    position: relative;
			    background-color: #fefefe;
			    margin: auto;
			    padding: 0;
			    border: 1px solid #888;
			    width: 32%;
			    top: 14%;
			    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
			    -webkit-animation-name: animatetop;
			    -webkit-animation-duration: 0.4s;
			    animation-name: animatetop;
			    animation-duration: 0.4s
			}

			@media screen and (max-width: 480px) {
				.modal-content {width: 80%; top: 5%;}
			}

			/* Add Animation */
			@-webkit-keyframes animatetop {
			    from {top:-300px; opacity:0}
			    to {top:0; opacity:1}
			}

			@keyframes animatetop {
			    from {top:-300px; opacity:0}
			    to {top:0; opacity:1}
			}

			/* The Close Button */
			.close {
			    color: white;
			    float: right;
			    font-size: 28px;
			    font-weight: bold;
			}

			.close:hover,
			.close:focus {
			    color: #000;
			    text-decoration: none;
			    cursor: pointer;
			}

			.modal-header {
			    padding: 2px 16px;
			    background-color: #f44336;
			    color: white;
			}

			.modal-body {padding: 2px 16px;}

			.modal-footer {
			    padding: 2px 16px;
			    background-color: #f44336;
			    color: white;
			}
		</style>
	</head>
	<body>
		<video loop muted autoplay class="blurVideo" src="images/bg.mp4"></video>

		<!-- The Modal -->
		<div id="myModal" class="modal">

		  <!-- Modal content -->
		  <div class="modal-content">
		    <div class="modal-header">
		      <span class="close">×</span>
		      <h2>	<?php
		      			if ($_GET['error']==1){
		      				echo "Error de autenticación";
		      			}elseif ($_GET['error']==2){
		      				echo "Error";
		      			}
		      		?>
   			  </h2>
		    </div>
		    <div class="modal-body">
		      <?php
			  	if ($_GET['error']==1){
			   		echo "<p>El nombre de usuario o la contraseña</p><p>son incorrectos...</p>";
		      	}elseif ($_GET['error']==2){
		      		echo "<p>Ya existe una cuenta con este nombre de usuario o correo.</p><p>Prueba de nuevo con otros.</p>";
		      	}
		      ?>
		    </div>
		    <div class="modal-footer">
		      <h3>Inténtalo de nuevo</h3>
		    </div>
		  </div>

		</div>
		<!-- cierrde Modal -->

		<div class="login-page">
		  <div class="form">
		  
		    <form method="post" class="register-form" action="sesion.php?make=1" style="display: <?php if ($_GET['error']==2){echo "block";}else{echo "none";}?>">
		      <input title="Ingrese un nombre de usuario" type="text" placeholder="Usuario" name="usu" required>
		      <input type="password" placeholder="Contraseña" name="pass" required title="Ingrese una contraseña">
		      <input type="email" placeholder="Email" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" name="email" required title="Ingrese un correo con el siguiente formato: ejemplo@ejemplo.com">
		      <button>crear</button>
		      <p class="message">¿Ya estás registrado? <a href="#">Ingresa</a></p>
		    </form>
			
		    <form method="post" class="login-form" action="sesion.php?log=1" style="display: <?php if ($_GET['error']==2){echo "none";}else{echo "block";}?>">
		      <input type="text" placeholder="Usuario o Email" name="usu_email" required title="Ingrese su nombre de usuario o correo electrónico">
		      <input type="password" placeholder="Contraseña" name="pass" required title="Ingrese su contraseña">
		      <button name="mama">iniciar sesión</button>
		      <p class="message">¿No estás registrado? <a href="#">Crear una cuenta</a></p>
		    </form>
			
		  </div>
		</div>

		<script>
			// Get the modal
			var modal = document.getElementById('myModal');

			// Get the <span> element that closes the modal
			var span = document.getElementsByClassName("close")[0];

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

			$(document).ready(function(){

				$('.message a').click(function(){
				   $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
				});

			});
		</script>
	
	</body>

</html>