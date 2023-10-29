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
    

</style>
 
<main>
    <div class="welcome" style="background-image: url('../img/trainstation.jpg');">
        <div class="overlay d-flex justify-content-center align-items-center">
        <?php if($_SESSION['type'] == 'admin'){ ?>
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="card ">
                            <div class="card-header bg-dark text-white d-flex justify-content-center text-center">
                                <h4>Add new user</h4>
                            </div>
                            <div class="card-body">

                                <form action="addUserScript.php" method="POST">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="firstname" class="mb-3"> First Name: </label>
                                            <input type="text" id="firstname" class="form-control" name="fname" placeholder="First Name">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="lastname" class="mb-3"> Last Name: </label>
                                            <input type="text" id="lastname" class="form-control" name="lname" placeholder="Last Name">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="emailaddress" class="mb-3"> Email Address: </label>
                                            <input type="email" id="emailaddress" name="email" class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="password" class="mb-3"> Password: </label>
                                            <input type="text" id="password" name="pwd" placeholder="Password" class="form-control">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="usertypeselection" class="mb-3"> User Type: </label>
                                            <select name="role" class="form-control">
                                                <option id="defaultvaluenull" value="" > --select-- </option>
                                                <option id="admin" value="admin" > Admin</option>
                                                <option id="user" value="user" > User</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12 mb-3 d-flex justify-content-center align-items-center">
                                            <button type="submit" for="adduser" name="addUser" class="btn btn-success btn-lg mx-3 mb-3">Add User</button> 
                                            <button type="submit" for="cancel" name="cancelAddUser" class="btn btn-primary btn-lg mb-3">Cancel</button> 
                                        </div>
                                        
                                    </div>
                                </form>

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
