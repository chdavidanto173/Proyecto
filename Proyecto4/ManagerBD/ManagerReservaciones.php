<?php


 


  switch ($_POST['accion']) {
    case 'SP': //select aeropuertos
          selectPasajeros();
        break;
    case 'SV': //select aeropuertos
          selectVuelos();
        break;       
    case "SR": //Guardar aeropuerto
          selectReservaciones();
        break; 
    case "GR": //Guardar aeropuerto
          insertReservacion();
        break;
    case "SRI": //cargar aeropuerto por id
          selectReservacionId();
        break;
    case "ER": //eliminar aeropuerto por id
          deleteReservacion();
        break;
}


function selectPasajeros(){
  try {
    date_default_timezone_set('UTC');
      $file_db = new PDO('sqlite:bd.db');
      $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $result = $file_db->query('SELECT * FROM pasajeros');
      $file_db = null;
      $resultado = "<option selected>Selecione pasajero...</option>";
      foreach($result as $row) {
        $resultado = $resultado . '<option value= "'.$row['id'].'">'.$row['nombre'].'</option>';
  }
  
  echo $resultado . '</select>';
    }
    catch(PDOException $e) {
      echo $e->getMessage();
    }
}

function selectVuelos(){
  try {
    date_default_timezone_set('UTC');
      $file_db = new PDO('sqlite:bd.db');
      $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $result = $file_db->query('SELECT * FROM vuelos');
      $file_db = null;
      $resultado = "<option selected>Selecione vuelo...</option>";
      foreach($result as $row) {
        $resultado = $resultado . '<option value= "'.$row['id'].'">'.$row['destino'].'   Salida: '.$row['fechaSalida'].'  Llegada: '.$row['fechaLlegada'].'</option>';
  }
  
  echo $resultado . '</select>';
    }
    catch(PDOException $e) {
      echo $e->getMessage();
    }
}

function selectReservaciones(){
  try {
    date_default_timezone_set('UTC');
      $file_db = new PDO('sqlite:bd.db');
      $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $result = $file_db->query('SELECT * FROM reservaciones');
      $file_db = null;
      $resultado = "";
      foreach($result as $row) {
        $resultado = $resultado . '<tr>
        <td>'.$row['pasajero'].'</td>
        <td>'.$row['destino'].'</td>
        <td>'.$row['aerolinea'].'</td>
        <td>'.$row['costo'].'</td>
        <td>'.$row['fechaSalida'].'</td>
        <td>'.$row['fechaLlegada'].'</td>
        <td><button type="button" class="btn btn-dark" onclick="cargarReservacion('.$row['id'].')">Editar</button>
        <button type="button" class="btn btn-danger" onclick="eliminarReservacion('.$row['id'].')">Eliminar</button></td>
      </tr>';
  }
  
  echo $resultado;
    }
    catch(PDOException $e) {
      echo $e->getMessage();
    }
}

function selectReservacionId(){
  try {
    date_default_timezone_set('UTC');
      $file_db = new PDO('sqlite:bd.db');
      $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $result = $file_db->query('SELECT * FROM reservaciones where id ='.$_POST['id']);
      $file_db = null;
      $resultado = "";
      foreach($result as $row) {
       $data =  $row['idPasajero'].','.$row['idVuelo'].','.$row['id'];
  
  }
  
  echo $data;
    }
    catch(PDOException $e) {
      echo $e->getMessage();
    }
}

function insertReservacion(){
  if($_POST['idReservacion'] == 0){
   try {
    $file_db = new PDO('sqlite:bd.db');
    $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $insert = "INSERT INTO reservaciones (id, pasajero, destino,costo,aerolinea,fechaSalida,fechaLlegada,idPasajero,idVuelo) VALUES (:id, :pasajero, :destino,:costo,:aerolinea,:fechaSalida,:fechaLlegada,:idPasajero,:idVuelo)";
    $stmt = $file_db->prepare($insert);
 
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':pasajero', $pasajero);
    $stmt->bindParam(':destino', $destino);
    $stmt->bindParam(':costo', $costo);
    $stmt->bindParam(':aerolinea', $aerolinea);
    $stmt->bindParam(':fechaSalida', $fechaSalida);
    $stmt->bindParam(':fechaLlegada', $fechaLlegada);
    $stmt->bindParam(':idPasajero', $idPasajero);
    $stmt->bindParam(':idVuelo', $idVuelo);
 
    $id = null;
    $pasajero = $_POST['pasajeroReservacion'];
    $destino = $_POST['destinoReservacion'];
    $costo = $_POST['costoReservacion'];
    $aerolinea = $_POST['aerolineaReservacion'];
    $fechaSalida = $_POST['fechaSalidaReservacion'];
    $fechaLlegada = $_POST['fechaLlegadaReservacion'];
    $idPasajero = $_POST['idPasajero'];
    $idVuelo = $_POST['idVuelo'];
 
    $stmt->execute();
    $file_db = null;

  }
  catch(PDOException $e) {
    echo $e->getMessage();
  }
}
else {
  try {
    $file_db = new PDO('sqlite:bd.db');
    $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
    $pasajero = $_POST['pasajeroReservacion'];
    $destino = $_POST['destinoReservacion'];
    $costo = $_POST['costoReservacion'];
    $aerolinea = $_POST['aerolineaReservacion'];
    $fechaSalida = $_POST['fechaSalidaReservacion'];
    $fechaLlegada = $_POST['fechaLlegadaReservacion'];
    $idPasajero = $_POST['idPasajero'];
    $idVuelo = $_POST['idVuelo'];
 
 	$update = "Update reservaciones set pasajero = '".$pasajero."' ,destino ='".$destino."',costo ='".$costo."' ,aerolinea ='".$aerolinea."' ,fechaSalida ='".$fechaSalida."' ,fechaLlegada ='".$fechaLlegada."' ,idPasajero ='".$idPasajero."' ,idVuelo ='".$idVuelo."' where id = ".intval($_POST['idReservacion']);
 		  $file_db->exec($update);
	$file_db = null;
    }
 catch(PDOException $e) {
    echo $e->getMessage();
  }
}
}

function deleteReservacion(){
  try {
    $file_db = new PDO('sqlite:bd.db');
    $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
    $delete = 'DELETE FROM reservaciones WHERE id = ?';
    $stmt = $file_db->prepare($delete);

 $stmt->bindParam(1, $_POST['id'], PDO::PARAM_INT);
 $stmt->execute();
    $file_db = null;

  }
  catch(PDOException $e) {
    echo $e->getMessage();
  }
}

?>