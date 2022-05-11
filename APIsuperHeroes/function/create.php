<?php 

include '../conexion/conexion.php';

if (empty($_POST['nombre']) || empty($_POST['grupoHeroe']) || empty($_POST['checkTipoPoder']) || empty($_POST['ciudadHeroe']) || empty($_POST['condicion']) || empty($_POST['vehiculo'])) {
		echo json_encode('Por favor llena todos los campos');
	} else {
		$nombre = $_POST['nombre'];
		$grupoHeroe = $_POST['grupoHeroe'];
		$checkTipoPoder = $_POST['checkTipoPoder'];
		$ciudadHeroe = $_POST['ciudadHeroe'];
		$condicion = $_POST['condicion'];
		$vehiculo = $_POST['vehiculo'];
		$consS = "INSERT into super (nomSuper, idGrupoHeroe, idCiudadHeroe, idCondicion, idVehiculo) VALUES ('$nombre', $grupoHeroe, $ciudadHeroe, $condicion, $vehiculo)";
		$queryS = mysqli_query($conexion, $consS);

		if ($queryS) {
			$consID = "SELECT max(idSuper) as ID from super";
			$queryID = mysqli_query($conexion, $consID);
			$fetchID = mysqli_fetch_assoc($queryID);

			foreach ($checkTipoPoder as $tipoPoder) {
				$consIDS = "INSERT into poderes (idSuper, idTipoPoder) VALUES (".$fetchID['ID'].", "."$tipoPoder.)";
				$queryIDS = mysqli_query($conexion, $consIDS);
			}
			unset($tipoPoder);
			echo json_encode('Nuevo super agregado');
		} else {
			echo json_encode('Sepa dios como se mostro este error');
		}
	}