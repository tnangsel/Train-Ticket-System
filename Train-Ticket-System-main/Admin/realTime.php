
<?php
include('../Authentication/connection.php');
include('../header.php');
?>
<style>

    .welcome {
        background-size: cover;
        min-height: 100vh;
        position: relative;
        color: black;
        text-shadow: 3px 3px 3px rgba(0, 0, 0, .2);
    }
    h5{
        font-size: 2rem;
        text-align: center;
        background-color: blue;
    }
    .overlay {
        position: absolute;
        height: 100%;
        width: 100%;
        background-color: rgba(0, 0, 0, .2);
    }

    table{
        min-width: 75rem;
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
    <div class="welcome" style="background-image: url('../img/trainstation.jpg');">
        <div class="overlay d-flex justify-content-center align-items-center">
        <?php if($_SESSION['type'] == 'admin'){ 
            date_default_timezone_set('America/Chicago');
            
            ?>
            <div class="container-fluid mx-5 mt-5 mb-5">
                    <div class="table table-responsive">
                        <div class="card-title text-white"><h5>Schedule List</h5></div>
                            <table id = "myTable" class="table table-striped table-hover">
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
                                        <!-- <th class=" text-center"></th> -->
                                    </tr>
                                </thead>
                                <?php 

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

                                        $dtime = date("g:i a", strtotime($train['departure_datetime']));
                                        $atime = date("g:i a", strtotime($train['arrival_datetime'])); 
                                        $current = time();
                                       
                                        ?>
                                        
                                    <tbody>
                                        <tr class="table-info border text-center">
                                            <td class="border text-center"><?php echo $train['train_number'] ?></td>
                                            <td class="border text-center"><?php $date = date("F j, Y", strtotime($train['departure_datetime'])); echo $date; ?></td>
                                            <td class="border text-center"><?php echo $train['departure']; ?></td>
                                            <td class="border text-center"><?php echo $train['arrival']; ?></td>
                                            <td class="border text-center"><?php  echo $dtime; ?></td> 
                                            <td class="border text-center"><?php echo $atime; ?></td>
                                            <td class="border text-center"><?php echo $time_diff->format('%hhrs %imins'); ?></td>
                                            <td class="border text-center"><?php echo $train['price']; ?></td>
                                        </tr>
                                    </tbody>
                                    <?php }
                                }else{ ?>
                                        <h2>No records to display.</h2>
                                    <?php    
                                } ?>
                            </table>
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
<!-- https://www.youtube.com/watch?v=dMoLQDudqI0 -->
<script>
    $(document).ready(function(){
        setTimeout(() => {
            location.reload();
        }, 3000);
    })
</script>
<?php
include('adminfooter.php');
?>
