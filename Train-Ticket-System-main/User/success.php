<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once '../Authentication/connection.php';
require_once __DIR__ . '/../stripe-php/init.php';
require_once '../phpqrcode/qrlib.php';
require '../phpMailer/PHPMailer.php';
require '../phpMailer/SMTP.php';
require '../phpMailer/Exception.php';

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
$t_id = $_SESSION['train_id'];
$user_id = $_SESSION['user_id'];
$order_description = $_SESSION['description'];
$order_quantity = $_SESSION['quantity'];
$order_amount = $payment_intent->amount / 100;
$order_currency = $payment_intent->currency;
$ticket_text = $order_description ."Payment: successful."; 

// Generate QR code
$path = '../ticket/';
$QRimage = time(). '.png';
$qrcode_file = $path.$QRimage;
QRcode::png($ticket_text, $qrcode_file, QR_ECLEVEL_H, 10);

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
    //Storing the payment information into the database under table payments
    $query = "INSERT INTO payments (id, t_id, description, quantity, total_price) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($dbConnect, $query);
    mysqli_stmt_bind_param($stmt, 'iisii', $user_id, $t_id, $order_description, $order_quantity, $order_amount);
    $result = mysqli_stmt_execute($stmt);
    if(!$result){
        echo "<script>
            alert('Payment records failed to store. Please contact admin @ team499ers@gmail.com')
            </script>";
    }else{

        $pay_id = mysqli_insert_id($dbConnect);
        //Storing tickets into the database
        $myQ = "INSERT INTO tickets (id, pay_id, ticket_text, qr_code) VALUES (?, ?, ?, ?)";
        $state = mysqli_prepare($dbConnect, $myQ);
        mysqli_stmt_bind_param($state, 'iiss', $user_id, $pay_id, $ticket_text, $qrcode_file);
        $result = mysqli_stmt_execute($state);
        echo "<script>
            alert('Ticket and Payment information saved successfully.')
            </script>";
    }
    echo "<script>
        alert('Thank you for your business! An email comfirmation has been sent to your email along with your ticket.')
        window.location.href='book.php';
        </script>"; 
}
 
?>