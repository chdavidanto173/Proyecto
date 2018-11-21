<?php


 


  switch ($_POST['accion']) {
    case 'SP': //select pasajeros
          selectPasajeros();
        break;
    case "GP": //Guardar pasajero
          insertPasajero();
        break;
    case "SPI": //cargar pasajero por id
          selectPasajeroId();
        break;
    case "EP": //eliminar pasajero por id
          deletePasajero();
        break;
}


function selectPasajeros(){
  try {
    date_default_timezone_set('UTC');
      $file_db = new PDO('sqlite:bd.db');
      $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $result = $file_db->query('SELECT * FROM pasajeros');
      $file_db = null;
      $resultado = "";
      foreach($result as $row) {
        $resultado = $resultado . '<tr>
        <td>'.$row['nombre'].'</td>
        <td>'.$row['nacionalidad'].'</td>
        <td>'.$row['genero'].'</td>
        <td>'.$row['fecha'].'</td>
        <td><button type="button" class="btn btn-dark" onclick="cargarPasajero('.$row['id'].')">Editar</button>
        <button type="button" class="btn btn-danger" onclick="eliminarPasajero('.$row['id'].')">Eliminar</button></td>
      </tr>';
  }
  
  echo $resultado;
    }
    catch(PDOException $e) {
      echo $e->getMessage();
    }
}

function selectPasajeroId(){
  try {
    date_default_timezone_set('UTC');
      $file_db = new PDO('sqlite:bd.db');
      $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $result = $file_db->query('SELECT * FROM pasajeros where id ='.$_POST['id']);
      $file_db = null;
      $resultado = "";
      foreach($result as $row) {
       $data =  $row['nombre'].','.$row['nacionalidad'].','.$row['genero'].','. $row['fecha'].','. $row['direccion'].','. $row['telefono'].','. $row['id'];
  
  }
  
  echo $data;
    }
    catch(PDOException $e) {
      echo $e->getMessage();
    }
}

function insertPasajero(){
  if($_POST['idPasajero'] == 0){
   try {
    $file_db = new PDO('sqlite:bd.db');
    $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $insert = "INSERT INTO pasajeros (id, nombre, nacionalidad,genero,fecha,direccion,telefono) VALUES (:id, :nombre, :nacionalidad,:genero,:fecha,:direccion,:telefono)";
    $stmt = $file_db->prepare($insert);
 
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':nacionalidad', $nacionalidad);
    $stmt->bindParam(':genero', $genero);
    $stmt->bindParam(':fecha', $fecha);
    $stmt->bindParam(':direccion', $direccion);
    $stmt->bindParam(':telefono', $telefono);
 
    $id = null;
    $nombre = $_POST['nombrePasajero'];
    $nacionalidad = $_POST['nacionalidadPasajero'];
    $genero = $_POST['generoPasajero'];
    $fecha = $_POST['fechaPasajero'];
    $direccion = $_POST['direccionPasajero'];
    $telefono = $_POST['telefonoPasajero'];
 
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

    $nombre = $_POST['nombrePasajero'];
    $nacionalidad = $_POST['nacionalidadPasajero'];
    $genero = $_POST['generoPasajero'];
    $fecha = $_POST['fechaPasajero'];
    $direccion = $_POST['direccionPasajero'];
    $telefono = $_POST['telefonoPasajero'];
 
 	$update = "Update pasajeros set nombre = '".$nombre."' ,nacionalidad ='".$nacionalidad."',genero ='".$genero."' ,fecha ='".$fecha."',direccion ='".$direccion."',telefono ='".$telefono."' where id = ".intval($_POST['idPasajero']);
 		  $file_db->exec($update);
	$file_db = null;
    }
 catch(PDOException $e) {
    echo $e->getMessage();
  }
}
}

function deletePasajero(){
  try {
    $file_db = new PDO('sqlite:bd.db');
    $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
    $delete = 'DELETE FROM pasajeros WHERE id = ?';
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