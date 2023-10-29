
<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include('Authentication/connection.php');
include('header.php');
?>

<style>

    .welcome {
        background-size: cover;
        min-height: 100vh;
        position: relative;
        color: black;
        text-shadow: 3px 3px 3px rgba(0, 0, 0, .2);
    }

    .overlay {
        position: absolute;
        height: 100%;
        width: 100%;
        background-color: rgba(0, 0, 0, .2);
    }

    .main {
        position: absolute;
        height: auto;
        width:100%;
        margin-top: 10rem;
        margin-bottom: 10rem;
        margin-left: 5rem;
        margin-right: 5rem;
    }
    .card {
        background-color: lightblue !important;
        display: absolute;
        align-items: center;
        justify-content: center;
        padding: 15px;
        border: 2px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
        max-width: 85rem;
        height: 5rem;
        margin: 0 auto;
        flex-wrap: wrap;
        z-index: 1;
    }

    label {
        margin-right: 10px;
        font-weight: bold;
        flex: 0 0 auto;
        text-align: right;
        padding-top: 8px;
        
    }

    input[type=text], input[type=date] {
        flex: 1 0 auto;
        padding: 8px;
        border-radius: 8px;
        border: 2px solid #ccc;
        box-sizing: border-box;
        margin-right: 10px;
        margin-bottom: 20px;
       
    }

    input[type=submit] {
        background-color: #4CAF50;
        color: white;
        width: 100%;
        width: 8rem;
        padding: 10px;
        border: 2px solid green;
        border-radius: 8px;
        cursor: pointer;
        font-size: 16px;
        margin-top: 15px;
        flex: 0 0 auto;
        margin-left: 13px;
       
    }
    .form-group {
        margin-bottom: 1rem;
    }

    /* Media queries for smaller screens */
    @media only screen and (max-width: 768px) {
        .form-group {
            display: block;
            width: 100%;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
        }

        input[type="text"],
        input[type="date"],
        input[type="submit"] {
            width: 100%;
        }
    }

    @media only screen and (max-width: 768px) {
        
        .card {
            max-width: 90%;
        }

        label, input[type=text], input[type=date] {
            font-size: 14px;
        }

        input[type=submit] {
            width: 100%;
            margin-left: 0;
        }
    }

    /* .form-group {
        margin-bottom: 1rem;
    }

    /* Media queries for smaller screens */
    @media only screen and (max-width: 768px) {
        .form-group {
            display: block;
            width: 100%;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
        }

        input[type="text"],
        input[type="date"],
        input[type="submit"] {
            width: 100%;
        }
    } */

    .accordion-button {
        background-color: lightblue !important;
        height: 6rem;
        margin-bottom: 1rem;
    }
    .accordion-item {
       
    }
    .columns {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
    }
    .column{
        width: 25%;
    }
    .column-right {
        width: 30%;
        text-align: right;
    }
    .book-btn {
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
    }
    h5 {
        height: 3rem;
        font-size: 2rem;
        text-align: left;
        text-align: center;
        border-radius: 5px;
        background-color: #cddd;
    }
    
    .center{
        text-align: center;
    }

    
    @media (max-width: 768){
        .welcome {
            min-height: 50vh;
        }
        h5 {
            font-size: 1.5rem;
        }

    } 

</style>    
                
<main> 
    <div class="welcome" style="background-image: url('img/railway.jpg');">
        <div class="overlay d-flex justify-content-center align-items-center">
        <?php 
            date_default_timezone_set('America/Chicago');
            
            ?>
            <div class="container">
                <div class="card sticky-top mt-5 mb-2">
                    <!-- Departure, Arrival and Date search form -->
                    <form method="POST">
                        <label for="departure">Departure</label>
                        <input type="text" id="departure" name="departure" placeholder="Enter departure station" value="<?php echo isset($_POST['departure']) ? $_POST['departure'] : ''; ?>" oninput="changeSearchButton()">

                        <label for="arrival">Arrival</label>
                        <input type="text" id="arrival" name="arrival" placeholder="Enter arrival station" value="<?php echo isset($_POST['arrival']) ? $_POST['arrival'] : ''; ?>" oninput="changeSearchButton()">

                        <label for="date-from">Date From</label>
                        <input type="date" id="date-from" name="date-from" value="<?php echo isset($_POST['date-from']) ? $_POST['date-from'] : ''; ?>" oninput="changeSearchButton()">

                        <label for="date-to">Date To</label>
                        <input type="date" id="date-to" name="date-to" value="<?php echo isset($_POST['date-to']) ? $_POST['date-to'] : ''; ?>" oninput="changeSearchButton()">

                        <input type="submit" id="search-button" name="search" value="Display">
                    </form>
                    <script>
                        function changeSearchButton() {
                            document.getElementById('search-button').value = 'Search';
                        }
                    </script>               
                </div>   
                <div class="card-title text-white"><h5>Train Schedules</h5></div>
                <?php 
                if(isset($_POST['search'])) {
                    $departure = strtoupper($_POST['departure']);
                    $arrival = strtoupper($_POST['arrival']);
                    $date_from = $_POST['date-from'];
                    $date_to = $_POST['date-to'];
                    
                    function validStation($fname, $lname){
                        //User input values must be alphabet letters only. 
                        $pattern = '/^[a-zA-Z]*$/';
                        if(preg_match($pattern, $fname)){
                            return true;
                        }
                        if(preg_match($pattern, $lname)){
                            return true;
                        }
                        return false;
                    }

                    if(validStation($departure, $arrival) == false){
                        echo "<script>
                            alert('Please enter valid station names!')
                            window.location.href='/TrainTicketWebApp/User/book.php';
                        </script>";
                    
                    }elseif(empty($departure) && empty($arrival) && empty($date_from) && empty($date_to)){
                        // Fetch all schedules without any filters
                        $stmt = mysqli_prepare($dbConnect, "SELECT * FROM schedules WHERE DATE(departure_datetime) >= CURDATE() ORDER BY departure_datetime ASC");
                    }elseif(empty($date_from) && empty($date_to)){
                        // Fetch schedules based on departure and arrival filters
                        $stmt = mysqli_prepare($dbConnect, "SELECT * FROM schedules WHERE (departure LIKE ? AND arrival LIKE ? AND DATE(departure_datetime) >= CURDATE()) ORDER BY departure_datetime ASC");
                        $search_departure = "%{$departure}%";
                        $search_arrival = "%{$arrival}%";
                        mysqli_stmt_bind_param($stmt, "ss", $search_departure, $search_arrival);
                    }elseif(empty($departure) && empty($arrival)){    
                        // Fetch schedules based on departure and arrival filters
                        $stmt = mysqli_prepare($dbConnect, "SELECT * FROM schedules WHERE DATE(departure_datetime) >= ? AND DATE(arrival_datetime) <= ? AND DATE(departure_datetime) >= CURDATE() ORDER BY departure_datetime ASC");
                        mysqli_stmt_bind_param($stmt, "ss", $date_from, $date_to);
                    }elseif(!empty($departure) && !empty($arrival) && !empty($date_from) && !empty($date_to)){
                        // Fetch schedules based on departure and arrival filters
                        $stmt = mysqli_prepare($dbConnect, "SELECT * FROM schedules WHERE (departure LIKE ? AND arrival LIKE ? AND DATE(departure_datetime) >= CURDATE()) AND DATE(departure_datetime) >= ? AND DATE(departure_datetime) <= ? AND DATE(departure_datetime) >= CURDATE() ORDER BY departure_datetime ASC");
                        $search_departure = "%{$departure}%";
                        $search_arrival = "%{$arrival}%";
                        mysqli_stmt_bind_param($stmt, "ssss", $search_departure, $search_arrival, $date_from, $date_to);
                    }
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if(mysqli_num_rows($result) > 0){    
                        while($train = mysqli_fetch_assoc($result)){  
                            // Set the start and end dates/times
                            $start_time = new DateTime($train['departure_datetime']);
                            $end_time = new DateTime($train['arrival_datetime']);
                    
                            // Calculate the time difference
                            $time_diff = $start_time->diff($end_time);
                            $duration = $time_diff->format('%hhrs %imins');
                            $dDate = date("F j, Y", strtotime($train['departure_datetime']));
                            $aDate = date("F j, Y", strtotime($train['arrival_datetime']));
                            $dtime = date("g:i a", strtotime($train['departure_datetime']));
                            $atime = date("g:i a", strtotime($train['arrival_datetime'])); 
                            $price = $train['price'];
                            $current = time();

                            //store values into session
                            // $_SESSION['train_num'] = $train['train_number'];
                            // $_SESSION['departure'] = $train['departure'];
                            // $_SESSION['arrival'] = $train['arrival'];
                            // $_SESSION['departureDate'] = $dDate;
                            // $_SESSION['arrivalDate'] = $aDate;
                            // $_SESSION['departureTime'] = $dtime;
                            // $_SESSION['arrivalTime'] = $atime;
                            // $_SESSION['duration'] = $duration;
                            // $_SESSION['price'] = $train['price'];
                            // $_SESSION['trainRoute'] = $train['train_route'];

                            ?>    
                                <div class="accordion" id="myAccordion">
                                    <form action="checkout.php" method="POST">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading<?php echo $train['train_number']; ?>">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $train['train_number']; ?>" aria-expanded="false" aria-controls="collapse<?php echo $train['train_number']; ?>">
                                                <p class="fs-5 fw-bold ms-2 me-3"><?php echo $train['departure']; ?></p>
                                                <input type="hidden" name="departure" value="<?php echo $train['departure']; ?>">
                                                <p class="fs-5 fw-bold ms-2 me-3"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-7 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/></svg></p>  
                                                <p class="fs-5 fw-bold ms-2 me-3"><?php echo $train['arrival']; ?></p>  
                                                <input type="hidden" name="arrival" value="<?php echo $train['arrival']; ?>">
                                                <p class="fs-5 fw-bold ms-2 me-3">|</p> 
                                                <p class="fs-5 fw-bold ms-2 me-3"><?php if($dDate === $aDate){ echo $dDate; }else{ echo $dDate. ' <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-7 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/></svg> ' . $aDate; }?></p>  
                                                <input type="hidden" name="departureDate" value="<?php echo $dDate; ?>"> 
                                                <input type="hidden" name="arrivalDate" value="<?php echo $aDate; ?>"> 
                                                <input type="hidden" name="route" value="<?php echo $train['train_route']; ?>"> 
                                            </button>
                                            </h2>
                                            <div id="collapse<?php echo $train['train_number']; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $train['train_number']; ?>" data-bs-parent="#myAccordion">
                                                <div class="accordion-body">
                                                    <div class="columns">
                                                        <div class="column">
                                                            <div class="d-flex align-items-center">
                                                                <p class="fs-7 fw-bold me-2">Departure Time:</p> 
                                                                <p class="fs-8"> <?php echo $dtime; ?></p>
                                                                <input type="hidden" name="departureTime" value="<?php echo $dtime; ?>">
                                                            </div>
                                                            <div class="d-flex align-items-center">
                                                                <p class="fs-7 fw-bold me-2">Duration:</p>
                                                                <p class="fs-8"><?php echo $duration; ?></p>
                                                                <input type="hidden" name="duration" value="<?php echo $duration; ?>">
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="column">
                                                            <div class="d-flex align-items-center">
                                                                <p class="fs-7 fw-bold me-2">Arrival Time:</p>
                                                                <p class="fs-8"><?php echo $atime; ?></p>
                                                                <input type="hidden" name="arrivalTime" value="<?php  echo $atime; ?>">
                                                            </div>
                                                            <div class="d-flex align-items-center">
                                                                <p class="fs-7 fw-bold me-2">Price:</p>
                                                                <p class="fs-8"> <?php echo $price; ?></p>
                                                                <input type="hidden" name="price" value="<?php echo $train['price']; ?>">
                                                            </div>
                                                        </div>
                                                            <!-- <div class="d-flex align-items-center">  
                                                                <p class="fs-7 fw-bold me-2">ETA: </p>
                                                                <p class="fs-8"><?php $realtime = $atime - $current; echo date('H:i:s', $realtime); ?></p>
                                                            </div> -->
                                                        <div class="column">
                                                            <div class="d-flex align-items-center">
                                                                <p class="fs-7 fw-bold me-2">Quantity: </p>
                                                                <p class="fs-8">
                                                                    <select name="quantity" required>
                                                                        <option value="1" selected>1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                    </select>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="column">
                                                            <div class="d-flex align-items-center">
                                                                <!-- <script src="https://js.stripe.com/v3/"></script> -->
                                                                <script>
                                                                    // Set your Stripe API public key
                                                                    var stripe = Stripe('pk_test_51MmTuWBhm51ejPYc3ocpqsXUAJaT7gBx79jRrUs6Wu7g69hNssmMCFj81goFwMEfrrxg9FGeFvTdLR7IKlbL5ASd0076EZZwQ1');

                                                                    // Add a click event listener to the button element
                                                                    var bookNowButton = document.querySelector('#book-now-button');
                                                                    bookNowButton.addEventListener('click', function(event) {
                                                                        event.preventDefault(); // Prevent the default form submission behavior

                                                                        // Create a Stripe token for the card information entered in the form
                                                                        stripe.createToken('card').then(function(result) {
                                                                        // Check if there was an error creating the token
                                                                        if (result.error) {
                                                                            // Display the error message to the user
                                                                            var errorElement = document.getElementById('card-errors');
                                                                            errorElement.textContent = result.error.message;
                                                                        } else {
                                                                            // Add the token to the form data and submit the form
                                                                            var tokenInput = document.createElement('input');
                                                                            tokenInput.setAttribute('type', 'hidden');
                                                                            tokenInput.setAttribute('name', 'stripeToken');
                                                                            tokenInput.setAttribute('value', result.token.id);
                                                                            var form = document.querySelector('form');
                                                                            form.appendChild(tokenInput);
                                                                            form.submit();
                                                                        }
                                                                        });
                                                                    });
                                                                </script>
                                                                <button name="book" type="submit" id="book-now-button" class="btn btn-primary me-3">Book Now</button>
                                                                    <div id="card-errors" role="alert"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                <?php }
                                }else{ ?>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="no-record-heading">
                                            <button class="accordion-button" type="button" disabled style="text-aglin: center;">
                                                No records to display.
                                            </button>
                                        </h2>
                                    </div>
                                <?php } 
                            ?>
                        </div>
                    </div>  
        <?php   }else{ 
                    $stmt = mysqli_prepare($dbConnect, "SELECT * FROM schedules WHERE DATE(departure_datetime) >= CURDATE() ORDER BY departure_datetime ASC");
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if(mysqli_num_rows($result) > 0){    
                        while($train = mysqli_fetch_assoc($result)){  
                            // Set the start and end dates/times
                            $start_time = new DateTime($train['departure_datetime']);
                            $end_time = new DateTime($train['arrival_datetime']);
                    
                            // Calculate the time difference
                            $time_diff = $start_time->diff($end_time);
                            $duration = $time_diff->format('%hhrs %imins');
                            $dDate = date("F j, Y", strtotime($train['departure_datetime']));
                            $aDate = date("F j, Y", strtotime($train['arrival_datetime']));
                            $dtime = date("g:i a", strtotime($train['departure_datetime']));
                            $atime = date("g:i a", strtotime($train['arrival_datetime'])); 
                            $price = $train['price'];
                            $current = time();

                            ?>    
                                <div class="accordion" id="myAccordion">
                                    <form action="checkout.php" method="POST">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading<?php echo $train['train_number']; ?>">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $train['train_number']; ?>" aria-expanded="false" aria-controls="collapse<?php echo $train['train_number']; ?>">
                                                <p class="fs-5 fw-bold ms-2 me-3"><?php echo $train['departure']; ?></p>
                                                <input type="hidden" name="departure" value="<?php echo $train['departure']; ?>">
                                                <p class="fs-5 fw-bold ms-2 me-3"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-7 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/></svg></p>  
                                                <p class="fs-5 fw-bold ms-2 me-3"><?php echo $train['arrival']; ?></p>  
                                                <input type="hidden" name="arrival" value="<?php echo $train['arrival']; ?>">
                                                <p class="fs-5 fw-bold ms-2 me-3">|</p> 
                                                <p class="fs-5 fw-bold ms-2 me-3"><?php if($dDate === $aDate){ echo $dDate; }else{ echo $dDate. ' <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-7 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/></svg> ' . $aDate; }?></p>  
                                                <input type="hidden" name="departureDate" value="<?php echo $dDate; ?>"> 
                                                <input type="hidden" name="arrivalDate" value="<?php echo $aDate; ?>"> 
                                                <input type="hidden" name="route" value="<?php echo $train['train_route']; ?>"> 
                                            </button>
                                            </h2>
                                            <div id="collapse<?php echo $train['train_number']; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $train['train_number']; ?>" data-bs-parent="#myAccordion">
                                                <div class="accordion-body">
                                                    <div class="columns">
                                                        <div class="column">
                                                            <div class="d-flex align-items-center">
                                                                <p class="fs-7 fw-bold me-2">Departure Time:</p> 
                                                                <p class="fs-8"> <?php echo $dtime; ?></p>
                                                                <input type="hidden" name="departureTime" value="<?php echo $dtime; ?>">
                                                            </div>
                                                            <div class="d-flex align-items-center">
                                                                <p class="fs-7 fw-bold me-2">Duration:</p>
                                                                <p class="fs-8"><?php echo $duration; ?></p>
                                                                <input type="hidden" name="duration" value="<?php echo $duration; ?>">
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="column">
                                                            <div class="d-flex align-items-center">
                                                                <p class="fs-7 fw-bold me-2">Arrival Time:</p>
                                                                <p class="fs-8"><?php echo $atime; ?></p>
                                                                <input type="hidden" name="arrivalTime" value="<?php  echo $atime; ?>">
                                                            </div>
                                                            <div class="d-flex align-items-center">
                                                                <p class="fs-7 fw-bold me-2">Price:</p>
                                                                <p class="fs-8"> <?php echo $price; ?></p>
                                                                <input type="hidden" name="price" value="<?php echo $train['price']; ?>">
                                                            </div>
                                                        </div>
                                                            <!-- <div class="d-flex align-items-center">  
                                                                <p class="fs-7 fw-bold me-2">ETA: </p>
                                                                <p class="fs-8"><?php $realtime = $atime - $current; echo date('H:i:s', $realtime); ?></p>
                                                            </div> -->
                                                        <div class="column">
                                                            <div class="d-flex align-items-center">
                                                                <p class="fs-7 fw-bold me-2">Quantity: </p>
                                                                <p class="fs-8">
                                                                    <select name="quantity" required>
                                                                        <option value="1" selected>1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                    </select>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="column">
                                                            <div class="d-flex align-items-center">
                                                                <!-- <script src="https://js.stripe.com/v3/"></script> -->
                                                                <script>
                                                                    // Set your Stripe API public key
                                                                    var stripe = Stripe('pk_test_51MmTuWBhm51ejPYc3ocpqsXUAJaT7gBx79jRrUs6Wu7g69hNssmMCFj81goFwMEfrrxg9FGeFvTdLR7IKlbL5ASd0076EZZwQ1');

                                                                    // Add a click event listener to the button element
                                                                    var bookNowButton = document.querySelector('#book-now-button');
                                                                    bookNowButton.addEventListener('click', function(event) {
                                                                        event.preventDefault(); // Prevent the default form submission behavior

                                                                        // Create a Stripe token for the card information entered in the form
                                                                        stripe.createToken('card').then(function(result) {
                                                                        // Check if there was an error creating the token
                                                                        if (result.error) {
                                                                            // Display the error message to the user
                                                                            var errorElement = document.getElementById('card-errors');
                                                                            errorElement.textContent = result.error.message;
                                                                        } else {
                                                                            // Add the token to the form data and submit the form
                                                                            var tokenInput = document.createElement('input');
                                                                            tokenInput.setAttribute('type', 'hidden');
                                                                            tokenInput.setAttribute('name', 'stripeToken');
                                                                            tokenInput.setAttribute('value', result.token.id);
                                                                            var form = document.querySelector('form');
                                                                            form.appendChild(tokenInput);
                                                                            form.submit();
                                                                        }
                                                                        });
                                                                    });
                                                                </script>
                                                                <button name="book" type="submit" id="book-now-button" class="btn btn-primary me-3">Book Now</button>
                                                                    <div id="card-errors" role="alert"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                <?php }
                                }else{ ?>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="no-record-heading">
                                            <button class="accordion-button" type="button" disabled style="text-aglin: center;">
                                                No records to display.
                                            </button>
                                        </h2>
                                    </div>
                                <?php } 
                            ?>
                        </div>
                    </div> 

             <?php } ?>
            </div> 
        </div> 
    </div>
</main>

                       
<!-- https://www.youtube.com/watch?v=dMoLQDudqI0 -->
 <!-- <script>
    $(document).ready(function(){
        setTimeout(() => {
            location.reload();
        }, 3000);
    })
</script>  -->

<?php
include('../footer.php');
?>