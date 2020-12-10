<?php

//PHPMAILER Confirmation of Sent
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include '../PHPMailer/src/Exception.php';
include '../PHPMailer/src/PHPMailer.php';
include '../PHPMailer/src/SMTP.php';

$enviadoAdmin  = "Mail Admin Enviado"               ;
$enviadoClient = "Mail Client Enviado"              ;
$firstName     = $_GET['firstName'];
$lastName      = $_GET['lastName'];
$email         = $_GET['email'];
$telefono      = $_GET['telefono'];
$titularNombre = $_GET['titularNombre'];
$referencia    = $_GET['referencia'];
$products      = json_decode($_GET['products'     ]);
$total         = $_GET['total'];
//Client Message



$message = '
        <div style="
        width: 100%;
        ">
        <img src="http://lagirlvzla.com/uploads/email.jpg" width="100%" alt="">
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
                <span style="font-weight: 600;">('.$products -> {$i} -> pQ.') </span>
                <span style="font-weight: 600;">'. $products -> {$i} -> pName .' </span>
                <span style="font-weight: 600;">$'. $products -> {$i} -> pPrice.' </span>
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
                <p>Telefono: <a href="tel:+584126642094">+58 0412-6642094</a></p>
                <p>E-Mail: <a href="mailto:info.lagirlvzla@gmail.com">info.lagirlvzla@gmail.com</a></p>
                <p>
                    <a href="https://instagram.com/lagirlvzla">
                        Siguenos en Instagram!
                    </a>
                </p>
            </div>
        </div>
        </div>
';


$mail = new PHPMailer();
//Server settings
// $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output

$mail->Username   = 'no-reply@lagirlvzla.com';              // SMTP username
$mail->Password   = 'Alg1120.93';                           // SMTP password
$mail->SMTPSecure = 'tls'; 
$mail->isSMTP();                          // Send using SMTP
$mail->Host       = 'mail.lagirlvzla.com';// Set the SMTP server to send through
$mail->Port       = 587;                                     
$mail->SMTPAuth   = true;// Enable SMTP authentication

//Recipients
$mail->setFrom($mail->Username, 'L.A. Venezuela');
$mail->addAddress($email, $firstName . ' ' . $lastName);// Add a recipient
// Content
$mail->isHTML(true);// Set email format to HTML
$mail->Subject = 'Pago Registrado en L.A. Girl Venezuela';
$mail->Body    = $message;
// $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

$enviado = $mail->send();
if($enviado){
    header('location: ../Pay/success');
}else{
    echo json_encode(array('msg' => 0));
}

//Admin Mail
// $message1 = '
//         <head>
//             <script src="https://kit.fontawesome.com/d5631b4b09.js" crossorigin="anonymous"></script>
//         </head>
//         <div style="
//         width: 100%;
//         ">
//         <img src="http://lagirlvzla.com/uploads/email.jpg" width="100%" alt="">
//         <div style="
//             padding-left: 2%;
//             padding-right: 2%;
//         ">
//             <h5 style="
//                 width: 100%;
//                 text-align: center;
//                 font-weight: 600;
//                 font-family:Arial, Helvetica, sans-serif;
//                 font-size: 13pt;
//             ">¡Hola un cliente llamado de hacer una Compra!</h5>
//             <p style="
//                 width: 100%;
//                 text-align:center;
//                 font-family:Arial, Helvetica, sans-serif;
//             ">Puedes comunicarte con tu cliente a través de los siguientes datos: </p>
//             <ul style="
//             font-family:Arial, Helvetica, sans-serif;
//             text-align:center;
//             list-style: none;
//             ">
//                 <li style="margin-bottom: 0.5%"><b>Nombre:</b> '. $firstName.' '.$lastName.'</li>
//                 <li style="margin-bottom: 0.5%"><b>E-mail:</b> '.$email.'</li>
//                 <li style="margin-bottom: 0.5%"><b>Telefono:</b> '.$telefono.'</li>
//             </ul>
//             <div style="
//                 font-family:Arial, Helvetica, sans-serif;
//                 background-color: #d9d9d9;
//                 padding-left: 2%;
//                 padding-right: 2%;
//                 padding-top: 1%;
//                 padding-bottom: 1%;
//                 margin-bottom: 2%;
//             ">
//                 <h5 style="
//                     width: 100%;
//                     text-align: center;
//                     font-weight: 600;
//                     font-size: 14pt;
//                 ">Tu Compra</h5>
//                 <hr>';

// for($i = 0; $i < count(get_object_vars($products)); $i++){
//     $message1 .= '<div style="
//                 display: flex;
//                 justify-content:space-between;
//             ">
//                 <span style="font-weight: 600;">('.$products -> {$i} -> pQ.')</span>
//                 <span style="font-weight: 600;">'. $products -> {$i} -> pName .'</span>
//                 <span style="font-weight: 600;">$'. $products -> {$i} -> pPrice.'</span>
//             </div>';
// }
// $message1 .= '<div style="
//                     width: 70%;
//                     background-color: #fff;
//                     padding-top: .5%;
//                     padding-bottom: .5%;
//                     padding-left: 1%;
//                     padding-right: 1%;
//                     margin-left: 15%;
//                     margin-top: 2%;
//                     margin-bottom: 2%;
//                     border-radius: 5px;
//                     text-align: center;
//                     font-weight: 600;
//                 ">
//                     TOTAL: $ '.$total.'
//                 </div>
//                 <p style="text-align:center">Numero de Referencia: <b>'.$referencia.'</b></p>
//             </div>
//             <div style="
//                 text-align:center;
//                 font-family:Arial, Helvetica, sans-serif;
//             ">
//                 <h5 style="font-weight: 600;">Contacto:</h5>
//                 <p>Telefono: <a href="tel:+584146525512">+58 414-6869358</a></p>
//                 <p>E-Mail: <a href="mailto:grupocomunicalatino@gmail.com">grupocomunicalatino@gmail.com</a></p>
//                 <p>
//                     <a href="https://instagram.com/comunicalatino">
//                         <i style="font-size: 20pt;"class="fab fa-instagram"></i>
//                     </a>
//                 </p>
//             </div>
//         </div>
//         </div>
// ';


// function sendMail($_firstName, $_lastName, $_email, $_message){
    // $mail = new PHPMailer();
    // try {
    //     //Server settings
    //     // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    //     $mail->isSMTP();                                            // Send using SMTP
    //     $mail->Host       = 'mail.lagirlvzla.com';                 // Set the SMTP server to send through
    //     $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    //     $mail->Username   = 'no-reply@lagirlvzla.com';              // SMTP username
    //     $mail->Password   = 'Alg1120.93';                           // SMTP password
    //     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
    //     $mail->Port       = 587;                                     // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //     //Recipients
    //     $mail->setFrom($mail->Username, 'L.A. Venezuela');
    //     $mail->addAddress($_email, $_firstName . ' ' . $_lastName);     // Add a recipient
    //     // Content
    //     $mail->isHTML(true);                                  // Set email format to HTML
    //     $mail->Subject = 'Pago Registrado en L.A. Girl Venezuela';
    //     $mail->Body    = $_message;
    //     // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
    //     $enviado = $mail->send();
    //     if($enviado){
    //         echo json_encode(array( 'msg' => 1 ));
    //     }else{
    //         echo json_encode(array('msg' => 0));
    //     }
    // } catch (Exception $e) {
    //     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    // }
    // return $enviado;
// }

// if(sendMail($firstName, $lastName, $email, $message)){
//     echo json_encode(array( 'msg' => 1 ));
// }else{
//     echo json_encode(array('msg' => 0));
// }
// header('location:../Pay/success/');





// $mail = new PHPMailer(true);

// try {
//     //Server settings
//     $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
//     $mail->isSMTP();                                            // Send using SMTP
//     $mail->Host       = 'mail.lagirlvzla.com';                    // Set the SMTP server to send through
//     $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
//     $mail->Username   = 'no-reply@lagirlvzla.com';                     // SMTP username
//     $mail->Password   = 'Alg1120.93';                               // SMTP password
//     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
//     $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

//     //Recipients
//     $mail->setFrom('no-reply@lagirlvzla.com', 'L.A. Girl Venezuela');
//     $mail->addAddress('vmweb.contact@gmail.com', 'VM WEB');     // Add a recipient
//     $mail->addReplyTo('juanjalvarezm571@gmail.com', 'Info L.A. Girl Venezuela');

//     // Content
//     $mail->isHTML(true);                                  // Set email format to HTML
//     $mail->Subject = 'Registro de pago Exitoso';
//     $mail->Body    = 'Esto es un <b>Test!</b>';
//     $mail->AltBody = 'Test';

//     $mail->send();
//     echo 'Message has been sent';
// } catch (Exception $e) {
//     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
// }
?>
