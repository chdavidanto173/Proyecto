
<?php

switch ($_POST['accion']) {

    case "AE": //Agregar Entrada
        insertarEntrada();
        break;

    case "CE": //Cargar Entradas
		cargarEntradas();
		break;
		
	case "SEI": //Cargar Entrada por Codigo
       selectEntradaCod();
      break;

    case 'EE': //Eliminar Entradas
		eliminarEntrada();
		break;
	
	 case 'CCombE': //Eliminar Entradas
		selectEventos();
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
             
                <a class="btn btn-primary" onclick="cargarEntrada('.$row['Codigo'].')"><i class="fa fa-edit"></i></a>
                <a class="btn btn-danger" onClick="eliminarEntrada('.$row['Codigo'].')"><i class="fa fa-trash-o"></i></a>
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
	  
	  
	  
	function selectEntradaCod(){
		try {
			$dbh = init();
			$result = $dbh->query('SELECT * FROM Entrada where Codigo ='.$_POST['cod']);
			$dbh = null;
			foreach($result as $row) {
				$data =  $row['Codigo'].','.$row['Cantidad'].','.$row['Precio'].','.$row['Estado'].','.$row['Tipo'].','.$row['CodigoEvento'];
			}
			echo $data;
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
 			$datos = "<option selected>Seleccionar Evento...</option>";
 			foreach($result as $row) {
 				$datos = $datos . '<option value= "'.$row['Codigo'].'">'.$row['Nombre'].'</option>';
 		}
 		
 		echo $datos .'</select>';
 		}
 			catch(PDOException $e) {
 			echo $e->getMessage();
 		}
 	}
	  
	  
	  

	  function insertarEntrada(){
		if($_POST['codEntrada'] == 0){
		try {
			$dbh = init();
			
			$insert = "INSERT INTO Entrada (Codigo, Cantidad, Precio, Estado, Tipo, CodigoEvento) VALUES (:Codigo, :Cantidad, :Precio, :Estado, :Tipo, :CodigoEvento)";
			$stmt = $dbh->prepare($insert);
		
			
			$stmt->bindParam(':Codigo', $codigo);
			$stmt->bindParam(':Cantidad', $cantidad);
			$stmt->bindParam(':Precio', $precio);
			$stmt->bindParam(':Estado', $estado);
			$stmt->bindParam(':Tipo', $tipo);
			$stmt->bindParam(':CodigoEvento', $codigoEvento);
		

			$cantidad = $_POST['cantidadEntrada'];
			$precio = $_POST['precioEntrada'];
			$estado = "vendida";
			$tipo = $_POST['tipoEntrada'];
			$codigoEvento = $_POST['eventoEntrada'] ;
			
		$cantidad = $_POST['cantidadEntrada'];
			$precio = $_POST['precioEntrada'];
			$estado = "vendida";
			$tipo = $_POST['tipoEntrada'];
			$codigoEvento = $_POST['eventoEntrada'] ;

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
		
		    $cantidad = $_POST['cantidadEntrada'];
			$precio = $_POST['precioEntrada'];
			$estado = "vendida";
			$tipo = $_POST['tipoEntrada'];
			$codigoEvento = $_POST['eventoEntrada'] ;
		
			$update = "Update Entrada set Cantidad = '".$cantidad."' ,Precio ='".$precio."' ,Estado ='".$estado."' ,Tipo ='".$tipo."' ,CodigoEvento ='".$codigoEvento."' where Codigo = ".$_POST['codEntrada'];
				$dbh->exec($update);
			$dbh = null;
			}
		catch(PDOException $e) {
			echo $e->getMessage();
		}
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
