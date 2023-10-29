
<?php
include('../Authentication/connection.php');
include('../header.php');
?>

<style>
        main {
            min-height: 100vh;
            min-width: 100vh;
        }
        /*  */
        .welcome {
            background-image: url('../img/trainstation.jpg');
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
        .card {
            min-width: 25rem;
            border: 2px solid white;;
            box-shadow: 0px 2px 0px rgba(0, 0, 0, 0.1);
        }

        .title{
            padding: 2px;
            margin-bottom: 30px;
            color: red;
            font-weight: bold;
            font-size: 3rem;
            text-mt-5: 2px 5px 2px yellow;
            
        }
        table {
            min-width: 75rem;
            
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
    <div class="welcome" alt="trainstation">
        <div class="overlay d-flex justify-content-center align-items-center">
        <?php if($_SESSION['type'] == 'admin'){ 
            date_default_timezone_set('America/Chicago');?>
            <div class="container-fluid mx-3 mt-5 mb-5">
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="card mt-5 mx-3">
                            <div class="card-header bg-dark text-white">
                                <div class="card-title text-center"><b>Add Train Schedule</b></div>
                            </div>
                            <div class="card-body">
                                <div class="container-fluid mt-5">
                                    <form action="addScheduleScript.php" method="POST">
                                        <input type="hidden" name="id" value="">
                                        <div class="mb-3">
                                            <label for="train_number" class="control-label text-black">Train No.</label>
                                            <input type="text" class="form-control" id="train_number" name="tnumber" value="" required="required">
                                        </div>
                                        <div class="mb-3">
                                            <label for="train_route" class="control-label text-black">Train Route</label>
                                            <input type="text" class="form-control" id="train_route" name="troute" value="" required="required">
                                        </div>
                                        <div class="mb-3">
                                            <label for="departurename" class="control-label">Departure Location</label>
                                            <input type="text" class="form-control" id="departurename" name="departure" value="" required="required">
                                        </div>
                                        <div class="mb-3">
                                            <label for="arrivalname" class="control-label">Arrival Location</label>
                                            <input type="text" class="form-control" id="arrivalname" name="arrival" value="" required="required">
                                        </div>
                                        <div class="mb-3">
                                            <label for="departuredate" class="form-label">Departure date and time:</label>
                                            <div class="input-group">
                                                <input type="date" class="form-control" id="departuredate" name="d_date" min="<?php echo date('Y-m-d'); ?>" value="" required>
                                                <span class="input-group-text">at</span>
                                                <input type="time" class="form-control" id="departuretime" name="d_time" min="<?php echo date('H:i'); ?>" required>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="arrivaldate" class="form-label">Arrival date and time:</label>
                                            <div class="input-group">
                                                <input type="date" class="form-control" id="arrivaldate" name="a_date" min="<?php echo date('Y-m-d'); ?>" value="" required>
                                                <span class="input-group-text">at</span>
                                                <input type="time" class="form-control" id="arrivaltime" name="a_time" min="" required>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="price" class="control-label">Price</label>
                                            <input type="text" class="form-control" id="Price" placeholder="00.00" name="price" value="" required="required">
                                        </div>
                                        <div class="card-footer py-3">
                                            <div class="d-grid gap-2">
                                                <button type="submit" name="add" class="btn btn-primary btn-er" for="add button">Add</button>
                                            </div>
                                        </div>
                                    </form>
                                    <script>
                                        var now = new Date();
                                        var hours = ('0' + now.getHours()).slice(-2);
                                        var minutes = ('0' + now.getMinutes()).slice(-2);
                                        var currentTime = hours + ':' + minutes;
                                        var dateInput = document.getElementById('departuredate');
                                        var timeInput = document.getElementById('departuretime');
                                        dateInput.addEventListener('change', function() {
                                            var selectedDate = new Date(this.value);
                                            var currentDate = new Date();
                                            if (selectedDate.getTime() == currentDate.getTime()) {
                                            timeInput.setAttribute('min', currentTime);
                                            } else {
                                            timeInput.removeAttribute('min');
                                            }
                                        });
                                    </script>

                                        <script>
                                            
                                            var departureDateInput = document.querySelector('input[name="d_date"]');
                                            var arrivalDateInput = document.querySelector('input[name="a_date"]');
                                            var departureTimeInput = document.querySelector('input[name="d_time"]');
                                            var arrivalTimeInput = document.querySelector('input[name="a_time"]');

                                            departureDateInput.addEventListener("input", function () {
                                                var departureDate = new Date(this.value);
                                                var nextDay = new Date(departureDate);
                                                nextDay.setDate(departureDate.getDate());
                                                arrivalDateInput.setAttribute("min", nextDay.toISOString().slice(0, 10));
                                            });

                                            arrivalDateInput.addEventListener("input", function () {
                                                var arrivalDate = new Date(this.value);
                                                var departureDate = new Date(departureDateInput.value);
                                                if (arrivalDate < departureDate) {
                                                this.value = "";
                                                alert("The arrival date must be after the departure date.");
                                                }
                                            });

                                            // Add an event listener to the arrival time input field
                                            arrivalTimeInput.addEventListener('input', function() {
                                                var departureDate = new Date(departureDateInput.value);
                                                var arrivalDate = new Date(arrivalDateInput.value);
                                                var departureTime = new Date('1970-01-01T' + departureTimeInput.value + ':00Z');
                                                var arrivalTime = new Date('1970-01-01T' + this.value + ':00Z');

                                                // Compare the arrival time to the departure time and display an error message if necessary
                                                if (departureDate.getTime() == arrivalDate.getTime() && departureTime >= arrivalTime) {
                                                this.value = '';
                                                alert('The arrival time must be later than the departure time.');
                                                }
                                            });

                                        </script> 
                                </div>
                            </div> 
                        </div>
                    </div>
                    
                
                    
                    <div class="col-lg-8 col-md-12 col-sm-12">
                        <div class="card mt-5  mb-5">
                            <div class="card-header bg-dark text-white">
                                <div class="card-title text-center"><b>Schedule List</b></div>
                            </div>
                            <div class="card-body">
                                <div class="container-fluid mt-3">
                                    <div class="table table-responsive">
                                    <?php 

                                        $stmt = mysqli_prepare($dbConnect, "SELECT * FROM schedules WHERE DATE(departure_datetime) >= CURDATE() ORDER BY departure_datetime ASC");
                                        mysqli_stmt_execute($stmt);
                                        $result = mysqli_stmt_get_result($stmt);
                                        if(mysqli_num_rows($result) > 0){ ?>
                                        <table id = "myTable" class="table table-responsive table-striped table-hover">
                                            <thead class="sticky-top border bg-dark text-white">
                                                <tr>
                                                    <th class="border text-center">Train Code</th>
                                                    <th class="border text-center">Date</th>
                                                    <th class="border text-center">Departure</th>
                                                    <th class="border text-center">Arrival</th>
                                                    <th class="border text-center">Departure Time</th>
                                                    <th class="border text-center">Arrival Time</th>
                                                    <th class="border text-center">Duration</th>
                                                    <th class="border text-center">Price</th>
                                                    <!-- <th class="border text-center">Status</th> -->
                                                    <!-- <th class=" text-center">Action</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php   
                                                while($train = mysqli_fetch_assoc($result)){  
                                                    // Set the start and end dates/times
                                                    $start_time = new DateTime($train['departure_datetime']);
                                                    $end_time = new DateTime($train['arrival_datetime']);

                                                    // Calculate the time difference
                                                    $time_diff = $start_time->diff($end_time);

                                                    $dtime = date("g:i a", strtotime($train['departure_datetime']));
                                                    $atime = date("g:i a", strtotime($train['arrival_datetime'])); 
                                                    $current = time();
                                                    
                                                    $price = $train['price'];
                                                    ?>
                                                
                                                
                                                    <tr class="table-info text-center">
                                                        <td class="border text-center"><?php echo $train['train_number'] ?></td>
                                                        <td class="border text-center"><?php $date = date("F j, Y", strtotime($train['departure_datetime'])); echo $date; ?></td>
                                                        <td class="border text-center"><?php echo $train['departure']; ?></td>
                                                        <td class="border text-center"><?php echo $train['arrival']; ?></td>
                                                        <td class="border text-center"><?php  echo $dtime; ?></td> 
                                                        <td class="border text-center"><?php echo $atime; ?></td>
                                                        <td class="border text-center"><?php echo $time_diff->format('%hhrs %imins'); ?></td>
                                                        <!-- <td class="border text-center"><?php $realtime = $atime - $current; echo date('H:i:s', $realtime); ?></td>-->
                                                        <td class="border text-center"><?php  echo $price; ?></td> 
                                                        <!-- <td class="border text-center">
                                                            <div class="dropdown">
                                                                <button class="btn btn-md btn-primary border border-dark dropdown-toggle rounded-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">Action</button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item" href="addScheduleScript.php?action=edit&id=<?= $train['t_id'] ?>">Edit</a></li>
                                                                    <li><a class="dropdown-item" href="addScheduleScript.php?action=delete&id=<?= $train['t_id'] ?>" onclick="if(confirm('Are you sure to delete this schedule?') == false) event.preventDefault();">Delete</a></li>
                                                                </ul>
                                                            </div>
                                                        </td> -->
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                        </table>
                                            <?php
                                        }else{ ?>
                                            <h2>No records to display.</h2>
                                    <?php    
                                    } ?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }else{
            echo "<script>
                alert('Unauthorized page! Please login with valid credentials. Thank you!')
                window.location.href='../index.php';
            </script>";
            
            } ?>   
        </div> 
    </div>

</main>

<?php
include('adminfooter.php');
?>
