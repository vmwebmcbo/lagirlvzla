<?php
include '../../php/comManager.php';
$manager = new Manager();

$id_delivery = $_POST['id_delivery'];

$result = $manager -> deleteDelivery($id_delivery);
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