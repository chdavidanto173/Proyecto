

<?php


switch ($_POST['accion']) {

    case 'SE': //seleccionar Eventos
      selectEventos();
      break;
	 
	case "SEI": //cargar Evento por Codigo
       selectEventoCod();
      break;

      case 'EE': //Eliminar Eventos
        eliminarEvento();
        break;
		
	 case 'SL': //seleccionar Lugares
        selectLugares();
        break;
		
	 case 'AE': //Agregar Evento
        insertEvento();
        break;
		
		
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
		
		
		
	
	function insertEvento(){
		if($_POST['codEvento'] == 0){
		try {
			$dbh = init();
			
			$insert = "INSERT INTO Evento (Nombre, FechaHora, Duracion, CodigoLugar) VALUES (:Nombre, :FechaHora, :Duracion,:CodigoLugar)";
			$stmt = $dbh->prepare($insert);
		
			$stmt->bindParam(':Nombre', $nombre);
			$stmt->bindParam(':FechaHora', $fechaHora);
			$stmt->bindParam(':Duracion', $duracion);
			$stmt->bindParam(':CodigoLugar', $codLugar);
		
			$nombre = $_POST['eveNombre'];
			$fechaHora = $_POST['eveFecha'];
			$duracion = $_POST['eveDuracion'];
			$codLugar = $_POST['eveLugar'];

			$stmt->execute();
			$dbh = null;
		}
		catch(PDOException $e) {
			echo $e->getMessage();
		}
		}
		else {
		try {
			$dbh = init();
			
			$nombre = $_POST['eveNombre'];
			$fechaHora = $_POST['eveFecha'];
			$duracion = $_POST['eveDuracion'];
			$codLugar = $_POST['eveLugar'];
		
			$update = "Update Evento set Nombre = '".$nombre."' ,FechaHora ='".$fechaHora."' ,Duracion ='".$duracion."' ,CodigoLugar ='".$codLugar. "' where Codigo = ".$_POST['codEvento'];
				$dbh->exec($update);
			$dbh = null;
			}
		catch(PDOException $e) {
			echo $e->getMessage();
		}
		}
	}

		
 	function selectLugares(){
 		try {
 			$dbh = init();
 			$result = $dbh->query('SELECT * FROM Lugar');
 			$dbh = null;
 			$datos = "<option selected>Seleccionar Lugar...</option>";
 			foreach($result as $row) {
 				$datos = $datos . '<option value= "'.$row['Codigo'].'">'.$row['Descripcion']. ', '.$row['Provincia'].', '.$row['Canton'].', '.$row['Distrito'].'</option>';
 		}
 		
 		echo $datos .'</select>';
 		}
 			catch(PDOException $e) {
 			echo $e->getMessage();
 		}
 	}
 
 
   function selectEventos(){
     try {
       $dbh = init();
       $result = $dbh->query('SELECT * FROM Evento');
       $dbh = null;
       $datos = "";
       foreach($result as $row) {
         $datos = $datos . '<tr>
         <td>'.$row['Codigo'].'</td>
         <td>'.$row['Nombre'].'</td>
         <td>'.$row['FechaHora'].'</td>
         <td>'.$row['Duracion'].'</td>
         <td>'.$row['CodigoLugar'].'</td>
         <td>
         <div class="btn-group"> 
         <a class="btn btn-primary" onclick="cargarEvento('.$row['Codigo'].')"><i class="fa fa-edit"></i></a>
         <a class="btn btn-danger" onClick="eliminarEvento('.$row['Codigo'].')"><i class="fa fa-trash-o"></i></a>
         </div>
         </td>
       </tr>';
	   
     }
     echo $datos;
       }
       catch(PDOException $e) {
       echo $e->getMessage();
       }
   }
   
   
   function selectEventoCod(){
		try {
			$dbh = init();
			$result = $dbh->query('SELECT * FROM Evento where Codigo ='.$_POST['cod']);
			$dbh = null;
			foreach($result as $row) {
				$data =  $row['Codigo'].','.$row['Nombre'].','.$row['FechaHora'].','.$row['Duracion'].','.$row['CodigoLugar'];
			}
			echo $data;
		}
		catch(PDOException $e) {
			echo $e->getMessage();
		}
	}
   
 
 
 
  function eliminarEvento(){
  try {
    $file_db = new PDO('sqlite:VentaEntradas.db');
    $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $delete = 'DELETE FROM evento WHERE codigo = ?';
    $stmt = $file_db->prepare($delete);

 $stmt->bindParam(1, $_POST['codigo'], PDO::PARAM_INT);
 $stmt->execute();
    $file_db = null;

  }
  catch(PDOException $e) {
    echo $e->getMessage();
  }
}


    ?>
