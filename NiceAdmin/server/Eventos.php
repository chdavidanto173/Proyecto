

<?php


switch ($_POST['accion']) {

    case 'SE': //seleccionar Eventos
      selectEventos();
      break;

      case 'EE': //seleccionar Eventos
        eliminarEvento();
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
            <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#myModal"><i class="icon_plus_alt2" tittle="Adquirir Entrada" ></i></a>
            <a class="btn btn-success" href="#"><i class="icon_check_alt2"></i></a>
            <a class="btn btn-danger" onClick="eliminarEvento('.$row['Codigo'].')"><i class="icon_close_alt2"></i></a>
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
