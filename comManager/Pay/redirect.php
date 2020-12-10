<?php 
    if(isset($_POST['msg']) == 'success'){  
        echo json_encode(array(
            'redirect' => '../mail/success-mail.php?name='.$_POST['name'].'&products='.$_POST['products'].'&prices='.$_POST['prices'].'&total='.$_POST['total']
            //'redirect' => './success/'
        ));
    }else{
        echo json_encode(array(
            'redirect' => './cancel/'
        ));
    }
    
?>