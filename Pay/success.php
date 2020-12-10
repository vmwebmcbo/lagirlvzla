<?php
$enviadoAdmin  = "Mail Admin Enviado"               ;
$enviadoClient = "Mail Client Enviado"              ;
$firstName     = $_GET['firstName'    ]             ;
$lastName      = $_GET['lastName'     ]             ;
$email         = $_GET['email'        ]             ;
$telefono      = $_GET['telefono'     ]             ;
$titularNombre = $_GET['titularNombre']             ;
$referencia    = $_GET['referencia'   ]             ;
$products      = json_decode($_GET['products'     ]);
$total         = $_GET['total'];

$message = '
        <head>
            <script src="https://kit.fontawesome.com/d5631b4b09.js" crossorigin="anonymous"></script>
        </head>
        <div style="
        width: 100%;
        ">
        <img src="../uploads/email.jpg" width="100%" alt="">
        <div style="
            padding-left: 2%;
            padding-right: 2%;
        ">
            <h5 style="
                width: 100%;
                text-align: center;
                font-weight: 600;
                font-family:Arial, Helvetica, sans-serif;
                font-size: 13pt;
            ">Hola '. $firstName.' '.$lastName.' ¡Gracias por tu compra en LA Girl Venezuela!</h5>
            <p style="
                width: 100%;
                text-align: center;
                font-family:Arial, Helvetica, sans-serif;
            ">Nuestro equipo se comunicará contigo para verificar tu información y acordar la entrega de tu compra</p>
            <div style="
                font-family:Arial, Helvetica, sans-serif;
                background-color: #d9d9d9;
                padding-left: 2%;
                padding-right: 2%;
                padding-top: 1%;
                padding-bottom: 1%;
                margin-bottom: 2%;
            ">
                <h5 style="
                    width: 100%;
                    text-align: center;
                    font-weight: 600;
                    font-size: 14pt;
                ">Tu Compra</h5>
                <hr>';

for($i = 0; $i < count(get_object_vars($products)); $i++){
    $message .= '<div style="
                display: flex;
                justify-content:space-between;
            ">
                <span style="font-weight: 600;">('.$products -> {$i} -> pQ.')</span>
                <span style="font-weight: 600;">'. $products -> {$i} -> pName .'</span>
                <span style="font-weight: 600;">$'. $products -> {$i} -> pPrice.'</span>
            </div>';
}
$message .= '<div style="
                    width: 70%;
                    background-color: #fff;
                    padding-top: .5%;
                    padding-bottom: .5%;
                    padding-left: 1%;
                    padding-right: 1%;
                    margin-left: 15%;
                    margin-top: 2%;
                    margin-bottom: 2%;
                    border-radius: 5px;
                    text-align: center;
                    font-weight: 600;
                ">
                    TOTAL: $ '.$total.'
                </div>
            </div>
            <div style="
                text-align:center;
                font-family:Arial, Helvetica, sans-serif;
            ">
                <h5 style="font-weight: 600;">Contacto:</h5>
                <p>Telefono: <a href="tel:+584146525512">+58 414-6869358</a></p>
                <p>E-Mail: <a href="mailto:grupocomunicalatino@gmail.com">grupocomunicalatino@gmail.com</a></p>
                <p>
                    <a href="https://instagram.com/comunicalatino">
                        <i style="font-size: 20pt;"class="fab fa-instagram"></i>
                    </a>
                </p>
            </div>
        </div>
        </div>
';

echo $message;
?>
