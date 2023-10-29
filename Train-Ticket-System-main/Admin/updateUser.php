<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include('../Authentication/connection.php');
include('../Authentication/function.php');

if($_SESSION['type'] == 'admin'){
    if(isset($_POST['cancelEdit'])){
        header('Location: /TrainTicketWebApp/Admin/viewAccount.php');
        exit();
    }
    if(isset($_POST['updateUser'])) {
        $user_id = $_POST['his_id'];
        $user_fname = htmlspecialchars($_POST['fname']);
        $user_lname = htmlspecialchars($_POST['lname']);
        $user_email = htmlspecialchars($_POST['email']);
        $user_pwd = htmlspecialchars($_POST['pwd']);
        $user_role = htmlspecialchars($_POST['role']);

        //Calling the validation functions for error handlers from function
        if(emptyUserInputUpdate($user_fname, $user_lname, $user_email, $user_pwd) == true){
            echo "<script> 
                    alert('Form cannot be empty!');
                    window.location.href='/TrainTicketWebApp/Admin/viewAccount.php';
                </script>";
                exit();
            
        }
        if(validName($user_fname, $user_lname) == false){
            echo "<script> 
                    alert('Only letters allowed for name!');
                    window.location.href='/TrainTicketWebApp/Admin/viewAccount.php';
                </script>";
                exit();
            
        }
        if(validEmail($user_email) == false){
            echo "<script> 
                    alert('Email is Invalid!');
                    window.location.href='/TrainTicketWebApp/Admin/viewAccount.php';
                </script>";
            
            exit();
        
        }
        if(passwordRule($user_pwd) == false){
            echo "<script> 
                    alert('Password must contain at least one capital letter, one number, and more than 6 in length.');
                    window.location.href='/TrainTicketWebApp/Admin/viewAccount.php';
                </script>";
            
            exit();
            
        }
        if(checkEmailTaken($dbConnect, $user_email, $user_id) == true){
            echo "<script> 
                    alert('Email already taken by other user!');
                    window.location.href='/TrainTicketWebApp/Admin/viewAccount.php';
                </script>";
           
            exit();
        }

        if(updateUser($dbConnect, $user_id, $user_fname, $user_lname, $user_email, $user_pwd, $user_role) == true){
            echo "<script> 
                        alert('User Update Successful!');
                        window.location.href='/TrainTicketWebApp/Admin/viewAccount.php';
                </script>";
            
            exit();
        }else{
            echo "<script> 
                        alert('Update User Failure!');
                        window.location.href='/TrainTicketWebApp/Admin/viewAccount.php';
                </script>";
            
            exit();
        }
    }
   
}

?>