

<?php


switch ($_POST['accion']) {

    case 'SP': //seleccionar Eventos
      selectPromotores();
      break;

      case 'AP': //seleccionar Eventos
       insertarPromotor();
        break;



      case 'CA':
        selectPromotorCod();
     break;

     case 'CP':
       selectPersonaCod();
    break;

    case 'EPE':
      eliminarPromotor();
   break;


   case 'EP':
     eliminarPersona();
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






   function selectPromotores(){

     try {
       $dbh = init();
       $result = $dbh->query('select Codigo,PorcentajeComision,CodigoEvento,Nombre,CodigoPersona  from PromotorEvento pE inner join persona p on pE.idPersona = p.id ;');
       $dbh = null;
       $datos = "";
       foreach($result as $row) {
         $datos = $datos . '<tr>
         <td>'.$row['Codigo'].'</td>
         <td>'.$row['PorcentajeComision'].'</td>
         <td>'.$row['CodigoEvento'].'</td>
         <td>'.$row['Nombre'].'</td>
         <td>
         <div class="btn-group">
         <a class="btn btn-primary" onclick="cargarPromotor('.$row['Codigo'].' , '.$row['CodigoPersona'].')"><i class="fa fa-edit"></i></a>
         <a class="btn btn-danger"  onClick="eliminarPromotor('.$row['Codigo'].', '.$row['CodigoPersona'].')" ><i class="fa fa-trash-o"></i></a>
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


   function insertarPromotor(){

 if($_POST['codigoPromotor'] == 0){
     try {
       $dbh = init();

       $insert = "INSERT INTO Persona (Id, Nombre, Direccion, Telefono) VALUES (:Id , :Nombre, :Direccion, :Telefono)";
       $stmt = $dbh->prepare($insert);



       $stmt->bindParam(':Id', $Id);
       $stmt->bindParam(':Nombre', $Nombre);
       $stmt->bindParam(':Direccion', $Direccion);
       $stmt->bindParam(':Telefono', $Telefono);




       $Id= $_POST['cedulaPersona'];
       $Nombre=   $_POST['nombrePersona'];
       $Direccion =  $_POST['direccionPersona'];
       $Telefono =  $_POST['telefonoPersona'];


       $stmt->execute();



       $insert = "INSERT INTO PromotorEvento (PorcentajeComision, CodigoEvento, IdPersona, NumeroCuenta) VALUES (:PorcentajeComision, :CodigoEvento, :IdPersona, :NumeroCuenta)";
       $stmt = $dbh->prepare($insert);



       $stmt->bindParam(':PorcentajeComision', $PorcentajeComision);
       $stmt->bindParam(':CodigoEvento', $CodigoEvento);
       $stmt->bindParam(':IdPersona', $IdPersona);
       $stmt->bindParam(':NumeroCuenta', $NumeroCuenta);




       $PorcentajeComision=   $_POST['comision'];
       $CodigoEvento =  5;
       $IdPersona =  $_POST['cedulaPersona'];
       $NumeroCuenta = 123;

       $stmt->execute();
       $dbh = null;


     }
     catch(PDOException $e) {
       echo $e->getMessage();
     }
}
else{

  try {
    $dbh = init();

    $Id= $_POST['cedulaPersona'];
    $Nombre=   $_POST['nombrePersona'];
    $Direccion =  $_POST['direccionPersona'];
    $Telefono =  $_POST['telefonoPersona'];

    $update = "Update Persona set Id = '".$Id."' ,Nombre ='".$Nombre."' ,Direccion ='".$Direccion."' ,Telefono ='".$Telefono."' where codigoPersona = ".$_POST['codigoPersona'];
    $dbh->exec($update);


    $PorcentajeComision=   $_POST['comision'];
    $CodigoEvento =  5;
    $IdPersona =  $_POST['cedulaPersona'];
    $NumeroCuenta = 123;


    $update = "Update PromotorEvento set CodigoEvento = '".$CodigoEvento."' ,PorcentajeComision ='".$PorcentajeComision."' ,CodigoEvento ='".$CodigoEvento."' ,IdPersona ='".$IdPersona."' ,NumeroCuenta ='".$NumeroCuenta."' where Codigo = ".$_POST['codigoPromotor'];
    $dbh->exec($update);


    $dbh = null;

    }
  catch(PDOException $e) {
    echo $e->getMessage();
  }


   }

	}





  function selectPromotorCod(){
   try {

     $dbh = init();

     $result = $dbh->query('SELECT * FROM PromotorEvento where Codigo = ' .$_POST['codigo'] );
     $dbh = null;
     foreach($result as $row) {
       $data =  $row['Codigo'].','.$row['PorcentajeComision'];
     }

     echo $data;
     }
     catch(PDOException $e) {
     echo $e->getMessage();
     }
     }


     function selectPersonaCod(){
      try {

        $dbh = init();
        $result = $dbh->query("SELECT * FROM Persona where CodigoPersona =" .$_POST['Id'] );

        $dbh = null;
        foreach($result as $row) {
          $data = $row['CodigoPersona'].','.$row['Id'].','.$row['Nombre'].','.$row['Direccion'].','.$row['Telefono'];
        }

     echo $data;
   }
   catch(PDOException $e) {
     echo $e->getMessage();
   }
 }


 function eliminarPromotor(){
 try {
   $file_db = new PDO('sqlite:VentaEntradas.db');
   $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   $delete = 'DELETE FROM PromotorEvento WHERE codigo = ?';
   $stmt = $file_db->prepare($delete);

$stmt->bindParam(1, $_POST['codigo'], PDO::PARAM_INT);
$stmt->execute();
   $file_db = null;

 }
 catch(PDOException $e) {
   echo $e->getMessage();
 }

 try {
   $file_db = new PDO('sqlite:VentaEntradas.db');
   $file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   $delete = 'DELETE FROM Persona WHERE CodigoPersona = ?';
   $stmt = $file_db->prepare($delete);

$stmt->bindParam(1, $_POST['Id'], PDO::PARAM_INT);
$stmt->execute();
   $file_db = null;

 }
 catch(PDOException $e) {
   echo $e->getMessage();
 }



}









    ?>
