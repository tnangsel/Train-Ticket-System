<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../Authentication/connection.php');
include('../Authentication/function.php');

if($_SESSION['type'] == 'admin'){
    if(isset($_POST['addUser'])){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $pwd = $_POST['pwd'];
        $type = $_POST['role'];
        
        if(emptyUserAdd($fname, $lname, $email, $pwd, $type) == true){
            echo "<script> 
                    alert('Form cannot be empty!');
                    // window.location.href='/TrainTicketWebApp/Admin/addUser.php';
                </script>";
                exit();
            
        }
        if(validName($fname, $lname) == false){
            echo "<script> 
                    alert('Only letters allowed for name!');
                    window.location.href='/TrainTicketWebApp/Admin/addUser.php';
                </script>";
                exit();
            
        }
        if(validEmail($email) == false){
            echo "<script> 
                    alert('Email is Invalid!');
                    window.location.href='/TrainTicketWebApp/Admin/addUser.php';
                </script>";
                exit();
        
        }
        if(passwordRule($pwd) == false){
            echo "<script> 
                    alert('Password must contain at least one capital letter, one number, and more than 6 in length.');
                    window.location.href='/TrainTicketWebApp/Admin/addUser.php';
                </script>";
            exit();
            
        }
        if(checkEmailExist($dbConnect, $email) == true){
            echo "<script> 
                    alert('Email already taken. Please try different email address to register.');
                    window.location.href='/TrainTicketWebApp/Admin/addUser.php';
                </script>"; 
            exit();
        }

        // Hash the user input password
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        if(adminAddUser($dbConnect, $fname, $lname, $email, $hashedPwd, $type) == true){
            echo "<script> 
                        alert('User Added Successful!');
                        window.location.href='/TrainTicketWebApp/Admin/viewAccount.php';
                </script>";
            exit();
        }else{
            echo "<script> 
                        alert('Fail to Add User!');
                        window.location.href='/TrainTicketWebApp/Admin/addUser.php';
                </script>";
            exit();
        }
    }
    if(isset($_POST['cancelAddUser'])){
        header('Location: /TrainTicketWebApp/Admin/viewAccount.php');
        exit();
    }
}

?>
