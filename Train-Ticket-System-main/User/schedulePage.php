<?php
include('../stripe/config.php');
include('Authentication/connection.php');
include('header.php');
?>

    <style>

        .welcome {
            background-image: url('img/railway.jpg');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            position: relative;
            color: black;
            text-shadow: 1px 2px 1px rgba(0, 0, 0, .2);
        }
        
        .overlay {
        
            position: absolute;
            height: 100%;
            width: 100%;
            
        }
        .title{
            padding: 2px;
            margin-bottom: 30px;
            color: red;
            font-weight: bold;
            font-size: 3rem;
            text-shadow: 2px 5px 2px yellow;
            /* border: 0.2rem solid blue;
            background-color: white;
            border-radius: 25px; */
        }
        table {
            /* min-width: 20rem; */
            border: 2px solid black;
        }
        label{
            border: 1px solid black;
            padding: 5px;
            margin: 2px;
            width: 30%;
            font-size: 1rem;
        }
    
        .select{
            /* border: 1px solid black; */
            padding: 5px;
            margin: 0px;
            
            
            font-size: 0.5rem;
            background-color: white;
        }
        .select:hover{
           
            color: white;
            background-color: blue;
        }
        
        @media screen (max-width: 767px){
            .welcome {
                min-height: auto;
            }
            .title {
                font-size: 2rem;
            }

        } 

    </style>
    <main> 
        <div class="welcome">
            <div class="overlay d-flex justify-content-center align-items-center"> 
                <div class="container-fluid mx-5 mt-5 mb-5">
                    <div class="row">
                        <div class="col-lg-4 col-md-12 col-sm-12">
                            <div class="card mt-5 mx-5">
                                <div class="card-header">
                                    <div class="card-title text-center"><b>Schedule Form</b></div>
                                </div>
                                <div class="card-body">
                                    <div class="container-fluid mt-5">
                                        <form action="" method="GET">
                                            <div class="header mb-2 text-white text-center">
                                                <label for="name" class="select-head label-control bg-dark">Train Number</label>
                                                <label for="destination" class="select-head control-label bg-dark">Start</label>
                                                <label for="duration" class="select-head control-label bg-dark">End</label>
                                            </div>
                                            <?php 
                                            if(isset($_GET['search'])){
                                                $startLocation = $_GET['startlocation'];
                                                $endLocation = $_GET['endlocation'];
                                                $sLocation = strtoupper($startLocation);
                                                $eLocation = strtoupper($endLocation);
                                                $pattern = '/^[a-zA-Z]*$/';
                                                if(preg_match($pattern, $sLocation) && preg_match($pattern, $eLocation)) {
                                                    
                                                    $stmt = mysqli_prepare($dbConnect, "SELECT * FROM schedules WHERE (departure = '$sLocation' AND arrival = '$eLocation') OR arrival = '$eLocation'");
                                                    mysqli_stmt_execute($stmt);
                                                    $result = mysqli_stmt_get_result($stmt);
                                                    if(mysqli_num_rows($result) > 0){
                                                        while($train = mysqli_fetch_assoc($result)){  ?>
                                                    
                                                            <div class="label mb-3 text-center">
                                                                <input type="hidden" name="train_id" value="<?php echo $train['t_id'];?>">
                                                                
                                                                <a style="text-decoration: none;" class="select" href="schedulePage.php?t_id=<?php echo $train['t_id'];?>">
                                                                    <label for="name" class=" label-control"><?php echo $train['train_number'];?></label>
                                                                    <label for="destination" class=" label-control"><?php echo $train['departure'];?></label>
                                                                    <label for="duration" class=" label-control"><?php echo $train['arrival'];?></label>
                                                                </a>     
                                                            </div>
                                                        <?php
                                                        }
                                                    }
                                                    $stmt = mysqli_prepare($dbConnect, "SELECT * FROM schedules WHERE (departure = '$sLocation' AND arrival = '$eLocation') OR departure = '$sLocation'");
                                                    mysqli_stmt_execute($stmt);
                                                    $result = mysqli_stmt_get_result($stmt);
                                                }else{
                                                    echo "<script>
                                                    alert('Invalid user input value')
                                                    window.location.href='/TrainTicketWebApp/schedulePage.php';
                                                   </script>";
                                                }

                                            }else{
                                                $stmt = mysqli_prepare($dbConnect, "SELECT * FROM schedules");
                                                mysqli_stmt_execute($stmt);
                                                $result = mysqli_stmt_get_result($stmt);
                                                while($train = mysqli_fetch_assoc($result)){  ?>
                                                
                                                    <div class="label mb-3 text-center">
                                                        <input type="hidden" name="train_id" value="<?php echo $train['t_id'];?>">
                                                        
                                                        <a style="text-decoration: none;" class="select" href="schedulePage.php?t_id=<?php echo $train['t_id'];?>">
                                                            <label for="name" class=" label-control"><?php echo $train['train_number'];?></label>
                                                        <!-- </a> -->
                                                        <!-- <a style="text-decoration: none;" class="select" href="schedulePage.php?t_id=<?php echo $train['t_id'];?>"> -->
                                                            <label for="destination" class=" label-control"><?php echo $train['departure'];?></label>
                                                        <!-- </a> -->
                                                        <!-- <a style="text-decoration: none;" class="select" href="schedulePage.php?t_id=<?php echo $train['t_id'];?>"> -->
                                                            <label for="duration" class=" label-control"><?php echo $train['arrival'];?></label>
                                                        </a>     
                                                    </div>
                                               
                                                <?php }
                                            }
                                             ?>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-12 col-sm-12">
                            <div class="card mt-5">
                                <div class="card-header">
                                    <div class="card-title text-center"><b>Schedule List</b></div>
                                </div>
                                <div class="card-body">
                                    <div class="container-fluid mt-3">
                                        <div class="table table-responsive">
                                        <?php 
                                            if(isset($_GET['t_id'])) {
                                                $train_id = $_GET['t_id'];
                                                $stmt = mysqli_prepare($dbConnect, "SELECT * FROM schedules WHERE t_id = '$train_id'");
                                                mysqli_stmt_execute($stmt);
                                                $result = mysqli_stmt_get_result($stmt);

                                                if(mysqli_num_rows($result) > 0){ ?>
                                                <div class="table table-responsive">
                                                <table class="table table-striped table-bordered table-hover">
                                                    <thead class="bg-dark text-white">
                                                        <tr>
                                                            <th class="">Date</th>
                                                            <th class="">Departure</th>
                                                            <th class="">Arrival</th>
                                                            <th class="">Departure time</th>
                                                            <th class="">Arrival time</th>
                                                            <th class="">Price</th>
                                                            <th class="text-center">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            while($train1 = mysqli_fetch_assoc($result)){ 
                                                                // Set the start and end dates/times
                                                                $start_time = new DateTime($train1['departure_datetime']);
                                                                $end_time = new DateTime($train1['arrival_datetime']);

                                                                // Calculate the time difference
                                                                $time_diff = $start_time->diff($end_time);

                                                                $dtime = date("g:i a", strtotime($train1['departure_datetime']));
                                                                $atime = date("g:i a", strtotime($train1['arrival_datetime'])); 
                                                                $current = time();
                                                                $price = $train1['price'];
                                                                $_SESSION['price'] = $price;
                                                                $_SESSION['trainRoute'] = $train1['train_route'];
                                                                $route = $_SESSION['trainRoute'];
                                                                ?>
                                                            <tr>
                                                                <td class="p-2"><?php $date = date("F j, Y", strtotime($train1['departure_datetime'])); echo $date; ?></td>
                                                                <td class="p-2"><?php echo $train1['departure'];?></td>
                                                                <td class="p-2"><?php echo $train1['arrival'];?></td>
                                                                <td class="p-2"><?php echo $dtime;?></td>
                                                                <td class="p-2"><?php echo $atime;?></td>
                                                                <th class="p-2"><?php echo $price;?></th>
                                                                <td class="text-center">
                                                                    <form action="checkout.php" method="POST">
                                                                        <script
                                                                            src="https://checkout.stripe.com/checkout.js"
                                                                            class="stripe-button"
                                                                            data-key="pk_test_51MmTuWBhm51ejPYc3ocpqsXUAJaT7gBx79jRrUs6Wu7g69hNssmMCFj81goFwMEfrrxg9FGeFvTdLR7IKlbL5ASd0076EZZwQ1"
                                                                            data-amount="<?php echo $price * 100; ?>"
                                                                            data-name="Train Ticket System"
                                                                            data-description="<?php echo $route; ?>"
                                                                            data-image="https://example.com/images/product-image.jpg"
                                                                            data-currency="usd"
                                                                            data-email="<?php echo "example@gmail.com"; ?>"
                                                                            data-locale="auto"
                                                                            
                                                                        ></script>
                                                                    </form>
                                                                   
                                                                </td>
                                                            </tr>
                                                        <?php 
                                                            } ?>
                                                    </tbody>
                                                </table>
                                                </div>
                                        <?php   }
                                           }
                                                       
                                                     ?>
                                                    
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="col-md-5">
                                <div class="row">
                                    <div class="card1 mt-5">
                                        <div class="card-body mb-2 bg-light text-black">
                                            <form action="" method="GET">
                                                <div class="row">
                                                    <div class="d-flex col-sm-5 my-2">
                                                        <label1 for="start location" class="form-label mb-3">Start</label>
                                                        <input type="text" name="startlocation" placeholder="start location" class="form-control">
                                                    </div>
                                                    <div class="d-flex col-sm-5 my-2">
                                                        <label1 for="end location"  class="form-label mb-3">End</label>
                                                        <input type="text" name="endlocation" placeholder="end location" class="form-control"> 
                                                        
                                                    </div>

                                                    <div class="d-flex col-sm-5 ms-auto">
                                                        <button type="submit" name="search" class="btn btn-md btn-primary mt-3">Search</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

         

<?php
include('footer.php');
?>          