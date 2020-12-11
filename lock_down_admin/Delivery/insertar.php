<?php
include '../../php/comManager.php';
$manager = new Manager();

$delivery_descri = $_POST['delivery_descri'];
$delivery_precio = $_POST['delivery_precio'];

$result = $manager -> insertDelivery($delivery_descri, $delivery_precio);
if($result){
    echo json_encode(array(
        'res' => 1 
    ));
}else{
    echo json_encode(array(
        'res' => 0
    ));
}

?>