<?php 
    if(isset($_POST['msg']) == 'success'){
        echo json_encode(array(
            'redirect' => './success/'
        ));
    }else{
        echo json_encode(array(
            'redirect' => './cancel/'
        ));
    }
    
?>