<?php


include('function.php');

if(isset($_POST["login"])){
    $email = htmlspecialchars($_POST["email"]);
    $pwd = htmlspecialchars($_POST["password"]);

    if(loginUser($dbConnect, $email, $pwd) == true){
        echo "<script>
                alert('User Login Successful!')
                window.location.href='/TrainTicketWebApp/index.php';
            </script>";
    }else{
        echo "<script>
                alert('Email or Password is incorrect!')
                window.location.href='/TrainTicketWebApp/login.php';
            </script>";
    }
}
?>