
<?php

switch ($_POST['accion']) {

    case "AE": //Guardar aerolinea
          insertarEntrada();
        break;

    case "CE": //Guardar aerolinea
              cargarEntradas();
            break;

    case 'EE': //seleccionar Eventos
    eliminarEntrada();
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



      function  cargarEntradas(){
        try {
          $dbh = init();
          $result = $dbh->query('SELECT * FROM Entrada');
          $dbh = null;
          $datos = "";
          foreach($result as $row) {
            $datos = $datos . '<tr>
            <td>'.$row['Codigo'].'</td>
            <td>'.$row['Cantidad'].'</td>
            <td>'.$row['Precio'].'</td>
            <td>'.$row['Estado'].'</td>
            <td>'.$row['Tipo'].'</td>
            <td>'.$row['CodigoEvento'].'</td>
            <td><div class="btn-group">
                <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#myModal"><i class="icon_plus_alt2" tittle="Adquirir Entrada" ></i></a>
                <a class="btn btn-success" href="#"><i class="icon_check_alt2"></i></a>
                <a class="btn btn-danger" onClick="eliminarEntrada('.$row['Codigo'].')"><i class="icon_close_alt2"></i></a>
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


      function insertarEntrada(){

         try {
          $file_db = new PDO('sqlite:VentaEntradas.db');
          $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          $insert = "INSERT INTO entrada (codigo, cantidad, precio,estado,tipo,codigoEvento) VALUES (:codigo, :cantidad, :precio, :estado, :tipo, :codigoEvento)";
          $stmt = $file_db->prepare($insert);

          $stmt->bindParam(':codigo', $codigo);
          $stmt->bindParam(':cantidad', $cantidad);
          $stmt->bindParam(':precio', $precio);
          $stmt->bindParam(':estado', $estado);
          $stmt->bindParam(':tipo', $tipo);
          $stmt->bindParam(':codigoEvento', $codigoEvento);


          $codigo = null;
          $cantidad = $_POST['cantidadEntrada'];
          $precio = $_POST['precioEntrada'];
          $estado = "vendida";
          $tipo = $_POST['tipoEntrada'];
          $codigoEvento = 1 ;

          $stmt->execute();
          $file_db = null;

        }
        catch(PDOException $e) {
          echo $e->getMessage();
        }
      }



      function eliminarEntrada(){
      try {
        $file_db = new PDO('sqlite:VentaEntradas.db');
        $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $delete = 'DELETE FROM entrada WHERE codigo = ?';
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
