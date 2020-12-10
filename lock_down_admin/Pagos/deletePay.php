<?php 
include '../../php/comManager.php';
include '../errHandler.php'    ;
$manager = new Manager(); //Manager Instance
//Info to update
$id_pago = $_POST['id_pago'];
if(isset($id_pago)){
    $paymentDeleted = $manager -> deletePay($id_pago);
    if($paymentDeleted){
        $messageWarning = 'El pago ha sido eliminado exitosamente';
    }else{
        $messageWarning = 'El pago no ha podido ser eliminado. Intentelo mas tarde!';
    }
}

echo json_encode(array(
    'messageWarning' => $messageWarning 
));
?>