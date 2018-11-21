<?php


 


  switch ($_POST['accion']) {
    case 'SA': //select agencias
          selectAgencias();
        break;
    case "GA": //Guardar agencia
          insertAgencias();
        break;
    case "SAI": //cargar agencia por id
          selectAgenciaId();
        break;
    case "EA": //eliminar agencia por id
          deleteAgencia();
        break;
}


function selectAgencias(){
  try {
    date_default_timezone_set('UTC');
      $file_db = new PDO('sqlite:bd.db');
      $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $result = $file_db->query('SELECT * FROM agencias');
      $file_db = null;
      $resultado = "";
      foreach($result as $row) {
        $resultado = $resultado . '<tr>
        <td>'.$row['nombre'].'</td>
        <td>'.$row['tipo'].'</td>
        <td>'.$row['origen'].'</td>
        <td>'.$row['telefono'].'</td>
        <td><button type="button" class="btn btn-dark" onclick="cargarAgencia('.$row['id'].')">Editar</button>
        <button type="button" class="btn btn-danger" onclick="eliminarAgencia('.$row['id'].')">Eliminar</button></td>
      </tr>';
  }
  
  echo $resultado;
    }
    catch(PDOException $e) {
      echo $e->getMessage();
    }
}

function selectAgenciaId(){
  try {
    date_default_timezone_set('UTC');
      $file_db = new PDO('sqlite:bd.db');
      $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $result = $file_db->query('SELECT * FROM agencias where id ='.$_POST['id']);
      $file_db = null;
      $resultado = "";
      foreach($result as $row) {
       $data =  $row['nombre'].','.$row['tipo'].','.$row['origen'].','. $row['ciudad'].','. $row['direccion'].','. $row['telefono'].','. $row['id'];
  
  }
  
  echo $data;
    }
    catch(PDOException $e) {
      echo $e->getMessage();
    }
}

function insertAgencias(){
  if($_POST['idAgencia'] == 0){
   try {
    $file_db = new PDO('sqlite:bd.db');
    $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $insert = "INSERT INTO agencias (id, nombre,tipo, origen,ciudad,direccion,telefono) VALUES (:id, :nombre,:tipo, :origen,:ciudad,:direccion,:telefono)";
    $stmt = $file_db->prepare($insert);
 
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':tipo', $tipo);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':origen', $origen);
    $stmt->bindParam(':ciudad', $ciudad);
    $stmt->bindParam(':direccion', $direccion);
    $stmt->bindParam(':telefono', $telefono);
 
    $id = null;
    $nombre = $_POST['nombreAgencia'];
    $tipo = $_POST['tipoAgencia'];
    $origen = $_POST['origenAgencia'];
    $ciudad = $_POST['ciudadAgencia'];
    $direccion = $_POST['direccionAgencia'];
    $telefono = $_POST['telefonoAgencia'];
 
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
    
    $nombre = $_POST['nombreAgencia'];
    $tipo = $_POST['tipoAgencia'];
    $origen = $_POST['origenAgencia'];
    $ciudad = $_POST['ciudadAgencia'];
    $direccion = $_POST['direccionAgencia'];
    $telefono = $_POST['telefonoAgencia'];
 
 	$update = "Update aeropuertos set nombre = '".$nombre."' ,tipo ='".$tipo."' ,origen ='".$origen."',ciudad ='".$ciudad."' ,aerolinea ='".$direccion."',telefono ='".$telefono."' where id = ".intval($_POST['idAgencia']);
 		  $file_db->exec($update);
	$file_db = null;
    }
 catch(PDOException $e) {
    echo $e->getMessage();
  }
}
}

function deleteAgencia(){
  try {
    $file_db = new PDO('sqlite:bd.db');
    $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
    $delete = 'DELETE FROM agencias WHERE id = ?';
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