<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once(__DIR__ . '/../stripe-php/init.php');
 \Stripe\Stripe::setApiKey('sk_test_51MmTuWBhm51ejPYceUvwVyUpBYlQwnQ3sP3d0jDqA2RsILF578QINx3sOCQDYFLvhfOY1sXTEGpdhSrA98S18Bdi00lxIk7vUp'); 
 
if(isset($_POST['book'])){
    // define variables
    $customer_email = $_SESSION['email'];
    $customer_name = $_SESSION['fname']. ' ' .$_SESSION['lname'];
    
    // Retrieve data from user
    $train_id = $_POST['train_id'];
    $route = $_POST['route'];
    $departure = $_POST['departure'];
    $arrival = $_POST['arrival'];
    $dDate = $_POST['departureDate'];
    $aDate = $_POST['arrivalDate'];
    if($dDate === $aDate){
      $date = $dDate;
    }else{
      $date = $dDate. " to " . $aDate;
    }
    $dTime = $_POST['departureTime'];
    $duration = $_POST['duration'];
    $aTime = $_POST['arrivalTime'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    
    $success_url = 'https://localhost/TrainTicketWebApp/User/success.php?session_id={CHECKOUT_SESSION_ID}'; // Replace with your success URL
    $cancel_url = 'https://localhost/TrainTicketWebApp/User/cancel.php?session_id={CHECKOUT_SESSION_ID}'; // Replace with your cancel URL

      $session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [
          [
            'price_data' => [
              'currency' => 'usd',
              'unit_amount' => $price * 100, 
              'product_data' => [
                'name' => 'Train Ticket System',
                'description' => 'Ticket payment for '. $departure. ' to '.$arrival.' on : '.$date. ' and time from : '. $dTime. ' to '.$aTime,
                
              ],
            ],
            'quantity' => $quantity,
          ],
        ],
        
        'customer_email' => $customer_email,
        'client_reference_id' => $customer_name,
        'mode' => 'payment',
        'success_url' => $success_url,
        'cancel_url' => $cancel_url,
      ]);

      
      //storing values into the session
      
      $_SESSION['train_id'] = $train_id;
      $_SESSION['trainRoute'] = $route;
      $_SESSION['departure'] = $departure;
      $_SESSION['arrival'] = $arrival;
      $_SESSION['departureDate'] = $dDate;
      $_SESSION['arrivalDate'] = $aDate;
      $_SESSION['departureTime'] = $dTime;
      $_SESSION['arrivalTime'] = $aTime;
      $_SESSION['price'] = $price; 
      $_SESSION['quantity'] = $quantity;  
      $_SESSION['description'] = $route. ' on: '.$dDate. ' at Time: '.$dTime. ' to ' .$aTime. '. ';

      // Redirect the user to the confirmation page
      header('Location: '. $session->url);
      exit;
}
?>
