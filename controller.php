<?php
function capturar_evento() {
	$vista = '';
	if($_GET) {
		if(array_key_exists('vista', $_GET)) {
			$vista = $_GET['vista'];
		}
	}
	return $vista;
}

function identificar_modelo($vista) {
	if($vista) {
		switch ($vista) {
			case 'vista_1':
				$modelo = 'ModeloUno';
				break;
			case 'vista_2':
				$modelo = 'ModeloDos';
				break;
			default:
				exit();
		}
	}
	return $modelo;
}

function invocar_modelo($modelo) {
	if($modelo) {
		print_r($modelo);
		echo '<br>';
		require_once('models.php');
		$data = new $modelo();
		print_r($data);
		echo '<br>';
		settype($data, 'array');
		print_r($data);
		echo '<br>';
		return $data;
	}
	#las modificaciones al modelo se harían aquí
}

function enviar_data() {
	$vista = capturar_evento();
	// print $vista.'<br>';
	if($vista) {
		$modelo = identificar_modelo($vista);
		// print $modelo.'<br>';
		if($modelo) {
			$data = invocar_modelo($modelo);
			// print_r($data);
			// echo '<br>';
			if($data) {
				require_once('view.php');
				render_data($vista, $data);
			}
		}
	}
}

enviar_data();