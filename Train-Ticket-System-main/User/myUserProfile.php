

<?php
include('../Authentication/connection.php');
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
        border: none;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        font-size: 1.5rem;
        font-weight: bold;
    }

    .form-label {
        font-weight: bold;
    }

    .btn {
        font-weight: bold;
    }

    @media (max-width: 767.98px) {
        .col-md-8 {
            max-width: 100%;
        }
    }
</style>
<main> 
    <div class="welcome">
        <div class="overlay d-flex justify-content-center align-items-center">
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header bg-primary text-white">Account Details</div>
                                <div class="card-body">
                                <?php if($_SESSION['type'] == 'user'){
                                    // Prepare a SQL statement to select the user's information from the users table
                                    $stmt = mysqli_prepare($dbConnect, "SELECT * FROM users");
                                    mysqli_stmt_execute($stmt);
                                    $result = mysqli_stmt_get_result($stmt);
                                    
                                    if(mysqli_num_rows($result) > 0){  
                                        while($user = mysqli_fetch_assoc($result)){
                                            if($user['id'] == $_SESSION['user_id']){    ?>
                                                <form action="updateProfile.php" method="POST">
                                                    <div class="col-md-3 mb-3">
                                                        <label for="id" class="form-label">ID</label>
                                                        <input type="text" class="form-control" id="id" value="<?php echo $user['id'] ?>" disabled>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="first-name" class="form-label">First Name</label>
                                                            <input type="text" class="form-control" id="first-name" name="fname" value="<?php echo $user['first_name'] ?>">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="last-name" class="form-label">Last Name</label>
                                                            <input type="text" class="form-control" id="last-name" name="lname" value="<?php echo $user['last_name'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="email-address" class="form-label">Email Address</label>
                                                            <input type="email" class="form-control" id="email-address" name="email" value="<?php echo $user['email_address'] ?>">
                                                        </div>
                                                        <div class="col-md-6 mb-5">
                                                            <label for="password" class="form-label"> Password: </label>
                                                            <input type="text" id="password" name="pwd" placeholder="Retype old password or create new" class="form-control" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <!-- <div class="col-md-3 mb-3">
                                                        <label for="usertypeselection" class="mb-3"> User Type: </label>
                                                        <input type="text" class="form-control" id="id"  value="<?php echo $user['user_type']  ?>" disabled>
                                                    </div> -->
                                                    <div class="col-md-12 mb-3 d-flex justify-content-center align-items-center">
                                                        <button type="submit" for="updateuserbutton" name="updateProfile" class="btn btn-success btn-lg mx-3 mb-3">Update Profile</button>
                                                        <button type="submit" for="cancelbutton" name="cancel" class="btn btn-primary btn-lg mb-3">Cancel</button> 
                                                    </div>
                                                </form>
                                        <?php }
                                            }
                                        //close the stmt
                                        mysqli_stmt_close($stmt);
                                    }else{ ?>
                                        <h4>No Records Found.</h4>
                                <?php }
                            //close the database connection
                            mysqli_close($dbConnect); 
                             }else{
                                echo "<script>
                                    alert('Unauthorized page! Please login with valid credentials. Thank you!')
                                    window.location.href='../index.php';
                                </script>";
                                
                                } ?>
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
include('userfooter.php');
?>