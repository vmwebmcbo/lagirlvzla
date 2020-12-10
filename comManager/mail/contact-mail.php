<?php
    /*use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require '../../PHPMailer/src/Exception.php';
    require '../../PHPMailer/src/PHPMailer.php';
    require '../../PHPMailer/src/SMTP.php';
    
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'localhost';                            // Set the SMTP server to send through
        $mail->SMTPAuth   = false;                                  // Enable SMTP authentication
        $mail->Username   = 'no-reply@aguademayoshop.com';          // SMTP username
        $mail->Password   = 'adm.2620201';                           // SMTP password
        $mail->SMTPAutoTLS = false; 
        $mail->Port       = 25;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('no-reply@aguademayoshop.com', 'Agua de Mayo Shop');
        $mail->addAddress('info@aguademayoshop.com', 'Information Agua de Mayo Shop');     // Add a recipient
        $mail->addReplyTo('info@aguademayoshop.com', 'Information Agua de Mayo Shop');
        $mail->addCC('no-reply@aguademayoshop.com');
        $mail->addBCC('no-reply@aguademayoshop.com');
        
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Message Sent from my website aguademayoshop.com';
        $mail->Body    = 'This is the HTML message body <b>in bold!</b> Go to my website <a href="https://aguademayoshop.com/comManager">aguademayoshop.com</a>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();
        //echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }*/
?>