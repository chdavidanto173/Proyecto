<?php


 


  switch ($_POST['accion']) {
    case 'SA': //select aeropuertos
          selectAeropuertos();
        break;
    case "GA": //Guardar aeropuerto
          insertAeropuertos();
        break;
    case "SAI": //cargar aeropuerto por id
          selectAeropuertoId();
        break;
    case "EA": //eliminar aeropuerto por id
          deleteAeropuerto();
        break;
}


function selectAeropuertos(){
  try {
    date_default_timezone_set('UTC');
      $file_db = new PDO('sqlite:bd.db');
      $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $result = $file_db->query('SELECT * FROM aeropuertos');
      $file_db = null;
      $resultado = "";
      foreach($result as $row) {
        $resultado = $resultado . '<tr>
        <td>'.$row['nombre'].'</td>
        <td>'.$row['origen'].'</td>
        <td>'.$row['ciudad'].'</td>
        <td>'.$row['aerolinea'].'</td>
        <td><button type="button" class="btn btn-dark" onclick="cargarAeropuerto('.$row['id'].')">Editar</button>
        <button type="button" class="btn btn-danger" onclick="eliminarAeropuerto('.$row['id'].')">Eliminar</button></td>
      </tr>';
  }
  
  echo $resultado;
    }
    catch(PDOException $e) {
      echo $e->getMessage();
    }
}

function selectAeropuertoId(){
  try {
    date_default_timezone_set('UTC');
      $file_db = new PDO('sqlite:bd.db');
      $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $result = $file_db->query('SELECT * FROM aeropuertos where id ='.$_POST['id']);
      $file_db = null;
      $resultado = "";
      foreach($result as $row) {
       $data =  $row['nombre'].','.$row['origen'].','.$row['ciudad'].','. $row['aerolinea'].','. $row['id'];
  
  }
  
  echo $data;
    }
    catch(PDOException $e) {
      echo $e->getMessage();
    }
}

function insertAeropuertos(){
  if($_POST['idAeropuerto'] == 0){
   try {
    $file_db = new PDO('sqlite:bd.db');
    $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $insert = "INSERT INTO aeropuertos (id, nombre, origen,ciudad,aerolinea) VALUES (:id, :nombre, :origen,:ciudad,:aerolinea)";
    $stmt = $file_db->prepare($insert);
 
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':origen', $origen);
    $stmt->bindParam(':ciudad', $ciudad);
    $stmt->bindParam(':aerolinea', $aerolinea);
 
    $id = null;
    $nombre = $_POST['nombreAeropuerto'];
    $origen = $_POST['origenAeropuerto'];
    $ciudad = $_POST['ciudadAeropuerto'];
    $aerolinea = $_POST['aerolineaAeropuerto'];
 
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
    $nombre = $_POST['nombreAeropuerto'];
    $origen = $_POST['origenAeropuerto'];
    $ciudad = $_POST['ciudadAeropuerto'];
    $aerolinea = $_POST['aerolineaAeropuerto'];
 
 	$update = "Update aeropuertos set nombre = '".$nombre."' ,origen ='".$origen."',ciudad ='".$ciudad."' ,aerolinea ='".$aerolinea."' where id = ".intval($_POST['idAeropuerto']);
 		  $file_db->exec($update);
	$file_db = null;
    }
 catch(PDOException $e) {
    echo $e->getMessage();
  }
}
}

function deleteAeropuerto(){
  try {
    $file_db = new PDO('sqlite:bd.db');
    $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
    $delete = 'DELETE FROM aeropuertos WHERE id = ?';
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