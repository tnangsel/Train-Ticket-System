<?php
include('../Authentication/connection.php');
include('../Authentication/function.php');

if($_SESSION['type'] == 'admin'){
    if(isset($_POST['add'])){

        $train_no = $_POST['tnumber'];
        $train_route = $_POST['troute'];
        $train_departure = $_POST['departure'];
        $train_arrival = $_POST['arrival'];
        $d_date = $_POST['d_date'];
        $d_time = $_POST['d_time'];
        $departure_datetime = date('Y-m-d H:i:s', strtotime("$d_date $d_time"));
        $a_date = $_POST['a_date'];
        $a_time = $_POST['a_time'];
        $arrival_datetime = date('Y-m-d H:i:s', strtotime("$a_date $a_time"));
        $price = $_POST['price'];

        if(trainNo($train_no) == false){
            echo "<script> 
                    alert('Please enter only numbers!');
                    window.location.href='/TrainTicketWebApp/Admin/manageSchedule.php';
                </script>";
                exit();
        }
        if(validateTrainRoute($train_route) == false){
            echo "<script> 
                    alert('Only letters and a hyphen allowed. eg: A-B');
                    window.location.href='/TrainTicketWebApp/Admin/manageSchedule.php';
                </script>";
                exit();
        }
        if(validateDepartureArrival($train_departure, $train_arrival) == false){
            echo "<script> 
                    alert('Please enter only letters.');
                    window.location.href='/TrainTicketWebApp/Admin/manageSchedule.php';
                </script>";
                exit();
        }
        if(trainScheduleAdd($dbConnect, $train_no, $train_route, $train_departure, $train_arrival, $departure_datetime, $arrival_datetime, $price) == false){
            echo "<script> 
                    alert('Fail to add schedule.');
                    window.location.href='/TrainTicketWebApp/Admin/manageSchedule.php';
                </script>";
                exit();
        }else{
            echo "<script> 
                    alert('Schedule added successful!');
                   window.location.href='/TrainTicketWebApp/Admin/manageSchedule.php';
                </script>";
                exit();
        }

    }
}


?>