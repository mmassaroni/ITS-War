<div class="j1">
	<h1<?php 
		if ($_SESSION['partida']->getcolJugadores()->getususPersPartida()[1]->getusuario() == $_SESSION['objUsu']->getid()) {
			echo " style='background-color:#3B8686'>";
		} else {
			echo ">";
		}
		echo nombreJugador($_SESSION['partida']->getcolJugadores()->getususPersPartida()[1]->getusuario());
		?>
		</h1>
	<div class="row vertical">
		<div class="img-per"><img src="/images/mrBean.gif" title="Nombre del Personaje"></div>
		<div class="valores-per">
			<h2>VIDA</h2>
				<div id="myProgress_vida">
					<div id="myBar_vida">
						<div id="label_vida">100</div>
					</div>
				</div>
			<h2>ENERGÍA</h2>
				<div id="myProgress_energia">
					<div id="myBar_energia"></div>
					<div id="label_energia">100</div>
				</div> 
			<h2>FUERZA<span> 5</span></h2>
			<hr>
			<h2>RESISTENCIA<span> 3</span></h2>
		</div>
	</div>
</div>
<hr/>
<div class="j2">
	<h1<?php 
		if ($_SESSION['partida']->getcolJugadores()->getususPersPartida()[2]->getusuario() == $_SESSION['objUsu']->getid()) {
			echo " style='background-color:#3B8686'>";
		} else {
			echo ">";
		}
		echo nombreJugador($_SESSION['partida']->getcolJugadores()->getususPersPartida()[2]->getusuario());
		?>
		</h1>
	<div class="row vertical">
		<div class="img-per"><img src="/images/mrBean.gif" title="Nombre del Personaje"></div>
		<div class="valores-per">
			<h2>VIDA</h2>
				<div id="myProgress_vida">
					<div id="myBar_vida">
						<div id="label_vida">100</div>
					</div>
				</div>
			<h2>ENERGÍA</h2>
				<div id="myProgress_energia">
					<div id="myBar_energia"></div>
					<div id="label_energia">100</div>
				</div> 
			<h2>FUERZA<span> 5</span></h2>
			<hr>
			<h2>RESISTENCIA<span> 3</span></h2>
		</div>
	</div>
</div>