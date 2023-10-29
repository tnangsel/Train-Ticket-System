     
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once __DIR__ . '/stripe-php/init.php';
require_once 'phpqrcode/qrlib.php';
require 'phpMailer/PHPMailer.php';
require 'phpMailer/SMTP.php';
require 'phpMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Set up Stripe API key
\Stripe\Stripe::setApiKey('sk_test_51MmTuWBhm51ejPYceUvwVyUpBYlQwnQ3sP3d0jDqA2RsILF578QINx3sOCQDYFLvhfOY1sXTEGpdhSrA98S18Bdi00lxIk7vUp');


// Retrieve the payment information using the session ID
$session_id = $_GET['session_id'];
$session = \Stripe\Checkout\Session::retrieve($session_id);
$payment_intent = \Stripe\PaymentIntent::retrieve($session->payment_intent);

// Extract order details from the session
$line_items = $session->display_items;
$order_description = $_SESSION['description'];
$order_quantity = $_SESSION['quantity'];
$order_amount = $payment_intent->amount / 100;
$order_currency = $payment_intent->currency;
$ticket = $order_description ."Payment: successful."; 

// Generate QR code
$qrcode_file = 'ticket/' . time() . '.png';
QRcode::png($ticket, $qrcode_file, QR_ECLEVEL_H, 10);

// Send email to customer with order details and QR code
$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'team499ers@gmail.com';
$mail->Password = 'ofudaygtrpbpvayc';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->setFrom('team499ers@gmail.com', 'Train Ticket System');
$mail->addAddress($session->customer_details->email);
$mail->isHTML(true);
$mail->Subject = 'Your order details';
$mail->Body = "Thank you for your business. Below are your order details. <br>" .
    "Order Description: {$order_description} <br>" .
    "Quantity: {$order_quantity} <br>" .
    "Order Amount: {$order_amount} {$order_currency}";

$mail->addAttachment($qrcode_file, 'QR Code.png');


if(!$mail->send()) {
    echo "<script>
        alert('Message could not be sent. Mailer Error: ', $mail->ErrorInfo;)
        window.location.href='book.php';
        </script>";
} else {
    echo "<script>
        alert('Thank you for your business! An email comfirmation has been sent to your email along with your ticket.')
        window.location.href='book.php';
        </script>"; 
}
 
?>
       
    
