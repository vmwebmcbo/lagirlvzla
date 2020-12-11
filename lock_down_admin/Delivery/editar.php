<?php
include '../../php/comManager.php';
$manager = new Manager();

$id_delivery = $_POST['id_delivery'];
$delivery_descri = $_POST['delivery_descri'];
$delivery_precio = $_POST['delivery_precio'];


$result = $manager -> updateDelivery($id_delivery, $delivery_descri, $delivery_precio);
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