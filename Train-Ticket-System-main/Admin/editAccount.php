<?php
include('../Authentication/connection.php');
include('../header.php');
?>
<style>

    .welcome {
        background-size: cover;
        min-height: 100vh;
        position: relative;
        color: black !important;
        text-shadow: 0px 1px 0px rgba(0, 0, 0, .5);
    }
    h4{
        font-size: 1.75rem;
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
            font-size: 0.75rem;
        }

    } 
    .card {
        width: 40rem;
        height: 30rem;
        
    }
    

</style>
 
<main>
    <div class="welcome" alt="trainstationimage"style="background-image: url('../img/trainstation.jpg');">
        <div class="overlay d-flex justify-content-center align-items-center">
        <?php if($_SESSION['type'] == 'admin'){ ?>
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="card">
                            <div class="card-header bg-dark text-white d-flex justify-content-center text-center ">
                                <h4>Update User Information</h4>
                            </div>
                            <div class="card-body">
                            <?php  
                            
                                if(isset($_GET['id'])) {
                                    $user_id = $_GET['id'];
                                    $stmt = mysqli_prepare($dbConnect, "SELECT * FROM users WHERE id = '$user_id'");
                                    mysqli_stmt_execute($stmt);
                                    $result = mysqli_stmt_get_result($stmt);

                                    if(mysqli_num_rows($result) > 0){
                                        while($user = mysqli_fetch_assoc($result)){ ?>

                                            <form action="updateUser.php" method="POST">
                                                <input type="hidden" name="his_id" value="<?php echo $user['id']; ?>">
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="firstname" class="mb-3"> First Name: </label>
                                                        <input type="text" id="firstname" name="fname" value="<?php echo $user['first_name']; ?>" class="form-control">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="lastname" class="mb-3"> Last Name: </label>
                                                        <input type="text" id="lastname" name="lname" value="<?php echo $user['last_name']; ?>" class="form-control">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="emailaddress" class="mb-3"> Email Address: </label>
                                                        <input type="email" id="emailaddress" name="email" value="<?php echo $user['email_address']; ?>" class="form-control">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="password" class="mb-3"> Password: </label>
                                                        <input type="text" id="password" name="pwd" placeholder="Retype old password or create new" class="form-control" autocomplete="off">
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label for="usertype" class="mb-3"> User Type: </label>
                                                        <select name="role" for="selection" class="form-control">
                                                            <option id="admin" value="admin" <?php echo $user['user_type'] == 'admin' ? 'selected':''; ?> > Admin</option>
                                                            <option id="user" value="user" <?php echo $user['user_type'] == 'user' ? 'selected':''; ?>> User</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12 mb-3 d-flex justify-content-center align-items-center">
                                                        <button type="submit" for="updateuserbutton" name="updateUser" class="btn btn-success btn-lg mx-3 mb-3">Update User</button>
                                                        <button type="submit" for="cancelbutton" name="cancelEdit" class="btn btn-primary btn-lg mb-3">Cancel</button> 
                                                    </div>
                                                </div>
                                            </form>

                                    <?php  }
                                    }else{ ?>
                                            <h4>No record available.</h4>
                                <?php   }
                                
                            }?>
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
