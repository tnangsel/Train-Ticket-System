<?php
// Include the Stripe PHP library
require_once('../strip-php/init.php');

// Set your Stripe API keys
\Stripe\Stripe::setApiKey('sk_test_51MmTuWBhm51ejPYceUvwVyUpBYlQwnQ3sP3d0jDqA2RsILF578QINx3sOCQDYFLvhfOY1sXTEGpdhSrA98S18Bdi00lxIk7vUp');

// Retrieve the user information from the session


$price = $_SESSION['price'];

// Create a Stripe Checkout session with metadata
$checkout_session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'],
    'line_items' => [[
        'name' => 'Train Ticketing System',
        'description' => 'Train Ticket Payment',
        'amount' => $price * 100,
        'currency' => 'usd',
        'quantity' => 1,
    ]],
    'success_url' => 'https://example.com/success?session_id={CHECKOUT_SESSION_ID}',
    'cancel_url' => 'https://example.com/cancel',
]);


// Handle the success URL
if (isset($_GET['session_id'])) {
    $session_id = $_GET['session_id'];
    $session = \Stripe\Checkout\Session::retrieve($session_id);

    if ($session->payment_status === 'paid') {
        // Send a confirmation email
        $to = "example@gmail.com";
        $subject = 'Payment Confirmation';
        $message = 'Thank you for your business!';
        $headers = 'From: Your Company <noreply@example.com>' . "\r\n";
        $headers .= 'Content-type: text/html' . "\r\n";

        mail($to, $subject, $message, $headers);

        // Output the confirmation message
        echo 'Thank you for your business!';
    } else {
        echo 'Payment error.';
    }
}
?>