
<?php
include('../header.php');
?>
<style>

    .welcome {
        background-image: url('../img/trainstation.jpg');
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

    @media (max-width: 768){
        .welcome {
            min-height: 50vh;
        }
        h4 {
            font-size: 3rem;
        }

    } 

    .card {
        border: 2px solid white;;
        box-shadow: 0px 2px 0px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        font-size: 1.75rem;
        font-weight: bold;
    }

    .form-label {
        font-weight: bold;
    }

    .btn {
        font-weight: bold;
    }

    @media (max-width: 767.98px) {
        .card-header{
            font-size: 0.75rem;
        }
        .col-md-8 {
            max-width: 100%;
        }
    }
</style>
<main> 
    <div class="welcome" alt="trainstation">
        <div class="overlay d-flex justify-content-center align-items-center">
        <?php if($_SESSION['type'] == 'admin'){ ?>
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header bg-dark text-white">Add Train Schedule</div>
                                <div class="card-body">
                                    <form action="addScheduleScript.php" class="action" method="POST">
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
                                                <input type="time" class="form-control" id="departuretime" name="d_time" value="<?php echo date('H:i'); ?>" required>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="arrivaldate" class="form-label">Arrival date and time:</label>
                                            <div class="input-group">
                                                <input type="date" class="form-control" id="arrivaldate" name="a_date" min="<?php echo date('Y-m-d'); ?>" value="" required>
                                                <span class="input-group-text">at</span>
                                                <input type="time" class="form-control" id="arrivaltime" name="a_time" value="<?php echo date('H:i'); ?>" required>
                                            </div>
                                        </div>
                                        <div class="card-footer py-3">
                                            <div class="d-grid gap-2">
                                                <button type="submit" name="add" class="btn btn-primary btn-sm rounded-0" for="add button">Add</button>
                                            </div>
                                        </div>
                                    </form>

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
                                            // Add an event listener to the departure time input field
                                            departureTimeInput.addEventListener('input', function() {
                                                var departureTime = new Date('1970-01-01T' + this.value + ':00Z');
                                                var arrivalTime = new Date('1970-01-01T' + arrivalTimeInput.value + ':00Z');

                                                // Compare the departure time to the arrival time and display an error message if necessary
                                                if (departureTime > arrivalTime) {
                                                arrivalTimeInput.value = '';
                                                alert('The arrival time must be after the departure time.');
                                                }
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
                                                var departureTime = new Date('1970-01-01T' + departureTimeInput.value + ':00Z');
                                                var arrivalTime = new Date('1970-01-01T' + this.value + ':00Z');

                                                // Compare the arrival time to the departure time and display an error message if necessary
                                                if (arrivalTime < departureTime) {
                                                this.value = '';
                                                alert('The arrival time must be after the departure time.');
                                                }
                                            });
                                        </script>
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
