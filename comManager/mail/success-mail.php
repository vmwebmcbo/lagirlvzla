<?php
$p = json_decode($_GET['products'], true);
$prices = json_decode($_GET['prices'], true);
$message = '
            <div style="-webkit-box-shadow: 0px 1px 16px -3px rgba(0,0,0,0.56); 
            box-shadow: 0px 1px 16px -3px rgba(0,0,0,0.56);background-color: rgb(98, 29, 126); width: 100%; font-family: -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Oxygen, Ubuntu, Cantarell, Open Sans, Helvetica Neue, sans-serif; padding-bottom: 5%;">
                <img src="https://i.ibb.co/dJ4Vjbx/logo-Rounded.png" alt="logo-Rounded" style="filter: brightness(100); padding-left: 15%;" width="70%" border="0 ">
                <h3 style="padding-top: 2%; margin-top: 3%; font-size: 18pt; text-align: center; color: #FFF; padding-bottom: 0%; ">
                    <b>'.$_GET['name'].'</b> Thanks for your purchase!
                </h3>
                <hr style="color: #fff; width: 50%; border: 1px solid #Fff;">
                <p style="text-align: justify; padding-left: 8%; padding-bottom: 3%; color: #fff; font-size: 12pt; padding-right: 8%; text-align:center;">
                    Your products will be shipped in a period of 2 to 10 days
                    <br>
                    <small style="color: #d1d1d1">If you have problems with your order contact us</small>
                </p>
                <div style="padding-top: 2%; padding-bottom: 2%; padding-left: 3%; padding-right:3%; box-sizing:border-box;width: 80%; border-radius: 10px; background-color:#fff; margin-left: 10%; ">
                    ';
                for($keys = 0; $keys < count($p); $keys++){
                    $message .= '<div style="width: 100%; display: flex; justify-content: space-between;"> 
                                        <span>' .$p[$keys] . '</span>
                                        <span style="background-color: rgb(98, 29, 126); text-align: center; padding-top: 1%;padding-bottom: 1%; padding-left: 1%; padding-right: 1%; color: #FFF;border-radius:10px"><b>' . $prices[$keys] . '</b></span>
                                </div>';
                    $message .= '<hr style="color: #fff; width: 100%; border: .5px solid #adadad;">';
                }
                $message .='
                    <div style="background-color: #23a138; text-align: center; width: 70%; padding-top: 2%; padding-bottom: 2%; font-size: 14pt; color: #fff; border-radius: 20px; font-weight: 700; margin-left: 15%;">
                        Total: '.$_GET['total'].'
                    </div>
                ';
            $message .='        
                </div>
            </div>
            <div style="font-size: 10pt; padding-left: 4%;padding-right: 3%;margin-top: 0%; padding-top: 2%; padding-bottom: 2%;  background-color: #e4e4e4; color: rgb(56, 24, 68); font-family: -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Oxygen, Ubuntu, Cantarell, Open Sans, Helvetica Neue, sans-serif;">  
                <b>Email Us:</b>
                <p style="margin: 0; padding: 0;">
                    info@aguademayoshop.com
                </p>
                <b>Call Us:</b>
                <p style="margin: 0; padding: 0;">
                    +1 5616511265165
                </p>
                <b>Follow Us on Instagram:</b>
                <p style="margin: 0; padding: 0;">
                    @aguademayoshop
                </p>
            </div>
            <script>console.log('.$_GET['products'].')</script>
        ';
        echo $message;   
        ?>