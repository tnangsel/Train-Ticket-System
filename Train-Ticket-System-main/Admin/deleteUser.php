<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../Authentication/connection.php');
include('../Authentication/function.php');

if($_SESSION['type'] == 'admin'){
    
    if(isset($_POST['deleteUser'])){

        $delete_id = $_POST['delete_id'];
        
        if(deleteUser($dbConnect, $delete_id) == true){
            echo "<script> 
                    alert('User deleted!');
                    window.location.href='viewAccount.php';
                </script>";
                exit();
        }else{
            echo "<script> 
                    alert('Failed to delete the User account!');
                    window.location.href='viewAccount.php';
                </script>";
                exit();
        }
    }
}