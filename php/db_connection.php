<?php
    function OpenCon(){
        $dbhost = 'localhost'  ;
        $dbuser = 'root';
        $dbpass = '';
        $dbname = 'lagirl_commanager';
        $options = array(
            PDO::ATTR_EMULATE_PREPARES => false, 
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"
         );
        $conn   = new PDO('mysql:host='.$dbhost.';dbname='.$dbname,$dbuser,$dbpass,$options);
        //$conn   = new mysqli($dbhost, $dbuser, $dbpass, $dbname) or die('Connection failed %s\n'.$conn -> error);
        return $conn;
    }
    function CloseCon($_conn){
        $_conn -> close();
    }
    
?>