<?php 
include '../../php/comManager.php';
include '../errHandler.php'    ;
$manager = new Manager(); //Manager Instance
//Info to update
$estado  = $_POST['estado' ];
$id_pago = $_POST['id_pago'];
$button  = $_POST['button' ];

if($estado == 0){
    $payProcess = $manager -> updatePayStatement($id_pago, 1);
    if($payProcess){
        //Confirmed Pay
        $payDone = '<button onclick="updatePayState(1,'.$id_pago.', btn'.$id_pago.')" class="text-success" style="border: none; background: none;"><i class="far fa-check-square"></i> Confirmado</button>';
    }else{
        //Pending Pay
        $payDone = '<button onclick="updatePayState(0,'.$id_pago.', btn'.$id_pago.')" class="text-warning" style="border: none; background: none;"><i class="fas fa-clock"></i> Pendiente</button>';
    }
}else{
    $payProcess = $manager -> updatePayStatement($id_pago, 0);
    if($payProcess){
        //Pending Pay
        $payDone = '<button onclick="updatePayState(0,'.$id_pago.', btn'.$id_pago.')" class="text-warning" style="border: none; background: none;"><i class="fas fa-clock"></i> Pendiente</button>';
    }else{
        //Confirmed Pay
        $payDone = '<button onclick="updatePayState(1,'.$id_pago.', btn'.$id_pago.')" class="text-success" style="border: none; background: none;"><i class="far fa-check-square"></i> Confirmado</button>';
    }
}

echo json_encode(array(
    'payDone' =>  $payDone,
    'button'  =>  $button
));
?>