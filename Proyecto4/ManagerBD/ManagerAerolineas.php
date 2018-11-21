<?php


 


  switch ($_POST['accion']) {
    case 'SA': //select Aerolineas
          selectAerolineas();
        break;
    case "GA": //Guardar aerolinea
          insertAerolinea();
        break;
    case "SAI": //cargar aerolinea por id
          selectAerolineaId();
        break;
    case "EA": //eliminar aerolinea por id
          deleteAerolinea();
        break;
}


function selectAerolineas(){
  try {
    date_default_timezone_set('UTC');
      $file_db = new PDO('sqlite:bd.db');
      $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $result = $file_db->query('SELECT * FROM aerolineas');
      $file_db = null;
      $resultado = "";
      foreach($result as $row) {
        $resultado = $resultado . '<tr>
        <td>'.$row['nombre'].'</td>
        <td>'.$row['origen'].'</td>
        <td>'.$row['telefono'].'</td>
        <td><button type="button" class="btn btn-dark" onclick="cargarAerolinea('.$row['id'].')">Editar</button>
        <button type="button" class="btn btn-danger" onclick="eliminarAerolinea('.$row['id'].')">Eliminar</button></td>
      </tr>';
  }
  
  echo $resultado;
    }
    catch(PDOException $e) {
      echo $e->getMessage();
    }
}

function selectAerolineaId(){
  try {
    date_default_timezone_set('UTC');
      $file_db = new PDO('sqlite:bd.db');
      $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $result = $file_db->query('SELECT * FROM aerolineas where id ='.$_POST['id']);
      $file_db = null;
      $resultado = "";
      foreach($result as $row) {
       $data =  $row['nombre'].','.$row['origen'].','.$row['administrador'].','. $row['telefono'].','. $row['id'];
  
  }
  
  echo $data;
    }
    catch(PDOException $e) {
      echo $e->getMessage();
    }
}

function insertAerolinea(){
  if($_POST['idAerolinea'] == 0){
   try {
    $file_db = new PDO('sqlite:bd.db');
    $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $insert = "INSERT INTO aerolineas (id, nombre, origen,administrador,telefono) VALUES (:id, :nombre, :origen,:administrador,:telefono)";
    $stmt = $file_db->prepare($insert);
 
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':origen', $origen);
    $stmt->bindParam(':administrador', $administrador);
    $stmt->bindParam(':telefono', $telefono);
 
    $id = null;
    $nombre = $_POST['nombreAerolinea'];
    $origen = $_POST['origenAerolinea'];
    $administrador = $_POST['administradorAerolinea'];
    $telefono = $_POST['telefonoAerolinea'];
 
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
    $nombre = $_POST['nombreAerolinea'];
    $origen = $_POST['origenAerolinea'];
    $administrador = $_POST['administradorAerolinea'];
    $telefono = $_POST['telefonoAerolinea'];
 
 	$update = "Update aerolineas set nombre = '".$nombre."' ,origen ='".$origen."',administrador ='".$administrador."' ,telefono ='".$telefono."' where id = ".intval($_POST['idAerolinea']);
 		  $file_db->exec($update);
	$file_db = null;
    }
 catch(PDOException $e) {
    echo $e->getMessage();
  }
}
}

function deleteAerolinea(){
  try {
    $file_db = new PDO('sqlite:bd.db');
    $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
    $delete = 'DELETE FROM aerolineas WHERE id = ?';
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