<?php


 


  switch ($_POST['accion']) {
    case 'SV': //select aeropuertos
          selectVuelos();
        break;
    case "GV": //Guardar aeropuerto
          insertVuelos();
        break;
    case "SVI": //cargar aeropuerto por id
          selectVueloId();
        break;
    case "EV": //eliminar aeropuerto por id
          deleteVuelo();
        break;
}


function selectVuelos(){
  try {
    date_default_timezone_set('UTC');
      $file_db = new PDO('sqlite:bd.db');
      $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $result = $file_db->query('SELECT * FROM vuelos');
      $file_db = null;
      $resultado = "";
      foreach($result as $row) {
        $resultado = $resultado . '<tr>
        <td>'.$row['destino'].'</td>
        <td>'.$row['numero'].'</td>
        <td>'.$row['costo'].'</td>
        <td>'.$row['fechaSalida'].'</td>
        <td>'.$row['fechaLlegada'].'</td>
        <td><button type="button" class="btn btn-dark" onclick="cargarVuelo('.$row['id'].')">Editar</button>
        <button type="button" class="btn btn-danger" onclick="eliminarVuelo('.$row['id'].')">Eliminar</button></td>
      </tr>';
  }
  
  echo $resultado;
    }
    catch(PDOException $e) {
      echo $e->getMessage();
    }
}

function selectVueloId(){
  try {
    date_default_timezone_set('UTC');
      $file_db = new PDO('sqlite:bd.db');
      $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $result = $file_db->query('SELECT * FROM vuelos where id ='.$_POST['id']);
      $file_db = null;
      $resultado = "";
      foreach($result as $row) {
       $data =  $row['destino'].','.$row['numero'].','.$row['costo'].','. $row['fechaSalida'].','. $row['fechaLlegada'].','. $row['id'];
  
  }
  
  echo $data;
    }
    catch(PDOException $e) {
      echo $e->getMessage();
    }
}

function insertVuelos(){
  if($_POST['idVuelo'] == 0){
   try {
    $file_db = new PDO('sqlite:bd.db');
    $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $insert = "INSERT INTO vuelos (id, destino, numero,costo,fechaSalida,fechaLlegada) VALUES (:id, :destino, :numero,:costo,:fechaSalida,:fechaLlegada)";
    $stmt = $file_db->prepare($insert);
 
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':destino', $destino);
    $stmt->bindParam(':numero', $numero);
    $stmt->bindParam(':costo', $costo);
    $stmt->bindParam(':fechaSalida', $fechaSalida);
    $stmt->bindParam(':fechaLlegada', $fechaLlegada);
 
    $id = null;
    $destino = $_POST['destinoVuelo'];
    $numero = $_POST['numeroVuelo'];
    $costo = $_POST['costoVuelo'];
    $fechaSalida = $_POST['fechaSalidaVuelo'];
    $fechaLlegada = $_POST['fechaLlegadaVuelo'];
 
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

    $destino = $_POST['destinoVuelo'];
    $numero = $_POST['numeroVuelo'];
    $costo = $_POST['costoVuelo'];
    $fechaSalida = $_POST['fechaSalidaVuelo'];
    $fechaLlegada = $_POST['fechaLlegadaVuelo'];
 
 	$update = "Update vuelos set destino = '".$destino."' ,numero ='".$numero."',costo ='".$costo."' ,fechaSalida ='".$fechaSalida."',fechaLlegada ='".$fechaLlegada."' where id = ".intval($_POST['idVuelo']);
 		  $file_db->exec($update);
	$file_db = null;
    }
 catch(PDOException $e) {
    echo $e->getMessage();
  }
}
}

function deleteVuelo(){
  try {
    $file_db = new PDO('sqlite:bd.db');
    $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
    $delete = 'DELETE FROM vuelos WHERE id = ?';
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