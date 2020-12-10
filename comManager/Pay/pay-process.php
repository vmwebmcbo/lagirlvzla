<?php
    include '../Stripe/init.php';
    // Set your secret key. Remember to switch to your live secret key in production!
    // See your keys here: https://dashboard.stripe.com/account/apikeys
    \Stripe\Stripe::setApiKey('sk_test_J0OmHV2p4v9xe1KNU6p7ToBZ00BpTpYgRQ');
    $total       =  $_POST['total'   ];
    $description =  $_POST['description1'];
    $intent = \Stripe\PaymentIntent::create([
        'amount' => $total,
        'currency' => 'usd',
        'payment_method_types' => ['card'],
        'description' => $description,
        // Verify your integration in this guide by including this parameter
        'metadata' => ['integration_check' => 'accept_a_payment'],
    ]);
    echo json_encode(array(
        'client_secret' => $intent->client_secret
    ));
?>