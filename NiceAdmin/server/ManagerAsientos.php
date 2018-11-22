<?php



	switch ($_POST['accion']) {
		case 'SA': //seleccionar Asientos
			selectAsientos();
			break;

	//	case "GA": //Guardar Asiento
	//		insertAsiento();
	//		break;
	//	case "SAC": //seleccionar Asiento por Codigo
	//		selectAsientoCod();
	//		break;
	//	case "EA": //eliminar Asiento por id
	//		deleteAsiento();
	//		break;
	}

	function init() {
		try {
			date_default_timezone_set('UTC');
			$dbh = new PDO('sqlite:VentaEntradas.db');
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $dbh;
		} catch (Exception $e) {
			die("Unable to connect: " . $e->getMessage());
		}
	}

	function selectAsientos(){
		try {
			$dbh = init();
			$result = $dbh->query('SELECT * FROM Asiento');
			$dbh = null;
			$datos = "";
			foreach($result as $row) {
				$datos = $datos . '<tr>
				<td>'.$row['Codigo'].'</td>
				<td>'.$row['Numero'].'</td>
				<td>'.$row['Fila'].'</td>
				<td><button type="button" class="btn btn-dark" onclick="cargarAsiento('.$row['Codigo'].')">Editar</button>
				<button type="button" class="btn btn-danger" onclick="eliminarAsiento('.$row['Codigo'].')">Eliminar</button></td>
			</tr>';
		}
		echo $datos;
			}
			catch(PDOException $e) {
			echo $e->getMessage();
			}
	}




//	function selectAsientoCod(){
//		try {
//			$dbh = $this->init();
//			$result = $file_db->query('SELECT * FROM Asiento where Codigo ='.$_POST['codigo']);
//			$dbh = null;
//			$datos = "";
//			foreach($result as $row) {
//			$datos =  $row['Codigo'].','.$row['Numero'].','.$row['Fila'];
//		}
//		echo $datos;
//			}
//			catch(PDOException $e) {
//			echo $e->getMessage();
//			}
//	}
//
//
//
//	function insertAsiento(){
//		if($_POST['codigoAsiento'] == 0){
//		try {
//			$dbh = $this->init();
//
//			$insert = "INSERT INTO Asiento (Codigo, Numero, Fila) VALUES (:codigo, :numero, :fila)";
//			$stmt = $dbh->prepare($insert);
//
//			$codigo = $_POST['codigoAsiento'];
//			$numero = $_POST['numeroAsiento'];
//			$fila = $_POST['filaAsiento'];
//
//			$stmt->bindParam(':codigo', $codigo);
//			$stmt->bindParam(':numero', $numero);
//			$stmt->bindParam(':fila', $fila);
//
//			$stmt->execute();
//			$dbh = null;
//
//		}
//		catch(PDOException $e) {
//			echo $e->getMessage();
//		}
//		}
//		else {
//		try {
//			$dbh = $this->init();
//
//			$codigo = $_POST['codigoAsiento'];
//			$numero = $_POST['numeroAsiento'];
//			$fila = $_POST['filaAsiento'];
//
//
//			$update = "Update Asiento set Numero = '".$numero."' ,fila ='".$fila."', where Codigo = ".$_POST['codigoAsiento']);
//				$dbh->exec($update);
//			$dbh = null;
//			}
//		catch(PDOException $e) {
//			echo $e->getMessage();
//		}
//		}
//	}
//
//
//	function deleteAsiento(){
//		try {
//			$dbh = $this->init();
//
//
//			$delete = 'DELETE FROM Asiento WHERE Codigo = ?';
//			$stmt = $dbh->prepare($delete);
//
//        $stmt->bindParam(1, $_POST['codigo'], PDO::PARAM_INT);
//        $stmt->execute();
//			$dbh = null;
//
//		}
//		catch(PDOException $e) {
//			echo $e->getMessage();
//		}
//	}
//


?>
