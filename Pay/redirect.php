<?php
    include '../php/comManager.php';
    $manager                = new Manager();
    if(isset($_POST['msg']) == 'success'){
        $nombre_cli   = $_POST['firstName'].' '.$_POST['lastName'];
        $email_cli    = $_POST['email'        ];
        $telefono_cli = $_POST['telefono'     ];
        $direccion_cli= $_POST['direccion'    ];
        $titularNombre= $_POST['titularNombre'];
        $referencia   = $_POST['referencia'   ];
        $method       = $_POST['method'       ];
        //Products
        $products     = json_decode($_POST['products']);
        $pFormatted   = '';
        for($i = 0; $i < count(get_object_vars($products)); $i++){
            $pFormatted .= '('.$products -> {$i} -> pQ.') '.$products -> {$i} -> pName.' ('.$products -> {$i} -> tProductName.') <b>$'.$products -> {$i} -> pPrice.'</b><br>';
        }
        $total        = $_POST['total'];
        //Transaction State
        $estado       = '0';
        //Get Date
        date_default_timezone_set("America/Caracas");
        $date = date('d/m/Y') .' ['. date('h:i').']';
        //Saving the information of payment in the DB
        $loadPayment  = $manager -> loadPay($nombre_cli, $email_cli, $telefono_cli, $direccion_cli, $titularNombre, $referencia, $method, $pFormatted, $total, $date, $estado);
        //Check if pay successfully loaded
        if($loadPayment){
            $redirect = '../mail/success-mail.php?firstName='.$nombre_cli.'&lastName= &email='.$email_cli.'&telefono='.$telefono_cli.'&titularNombre='.$titularNombre.'&referencia='.$referencia.'&products='.$_POST['products'].'&total='.$total.'&date='.$date;
        }else{
            $redirect = '../';
        }
        echo json_encode(array(
            'redirect' => $redirect
        ));
    }else{
        echo json_encode(array(
            'redirect' => './cancel/'
        ));
    }

?>
