

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
        text-shadow: 1px 0px 0px rgba(0, 0, 0, .5);
        border: black;
    }
    
    .overlay {
        position: absolute;
        height: 100%;
        width: 100%;
        background-color: rgba(0, 0, 0, .15);
    }

    table {
        min-width: 75rem;
        border: 2px solid white;
    }

    @media (max-width: 768){
        .welcome {
            min-height: 50vh;
        }
        table {
            min-width: 50vh;
        }

    } 
    

</style>
<main> 
<div class="welcome" alt="trainstationimage" style="background-image: url('../img/trainstation.jpg');">
    <div class="overlay d-flex justify-content-center align-items-center">
    <?php if($_SESSION['type'] == 'admin'){ ?>
        <div class="table-responsive table-lg">
            <a href="addUser.php" style="text-decoration: none;"><button type="button" for="adduser" class="btn btn-success btn-lg mb-3 d-flex ms-auto">Add User</button></a>
            <table class="table table-lg border table-striped table-hover text-center">
            <?php   
                
                // Prepare a SQL statement to select the user's information from the users table
                $stmt = mysqli_prepare($dbConnect, "SELECT * FROM users");
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if(mysqli_num_rows($result) > 0){ ?>
                <thead class="table-dark ">
                    <tr>
                        <th class="border" for="userID">User ID</th>
                        <th class="border" for="firstname">First Name</th>
                        <th class="border" for="lastname">Last Name</th>
                        <th class="border" for="emailaddress">Email Address</th>
                        <th class="border" for="hashedpassword">Hashed Password</th>
                        <th class="border" for="usertype">User Type</th>
                        <th class="border" for="edit">Edit</th>
                        <th class="border" for="delete">Delete</th>
                    </tr> 
                </thead>
                <?php   
                    while($user = mysqli_fetch_assoc($result)){   ?>
                        
                        <tr id="<?php echo $user['id']; ?>" class="table-success border text-center">
                            <td  for="user ID"><?php echo $user['id']; ?></td>
                            <td  for="first name"><?php echo $user['first_name']; ?></td>
                            <td  for="last name"><?php echo $user['last_name']; ?></td>
                            <td  for="email address"><?php echo $user['email_address']; ?></td>
                            <td  for="password">*******</td>
                            <td  for="user type"><?= $user['user_type']; ?></td> 
                            <td  for="edit"><a href="editAccount.php?id=<?php echo $user['id']; ?>" class="btn btn-primary btn-md">Edit</a></td>
                            <td>
                                <form action="deleteUser.php?id=<?php echo $user['id']; ?>" method="POST">
                                    <input type="hidden" name="delete_id" value="<?php echo $user['id']; ?>">
                                    <button type="submit" for="delete" name="deleteUser" class="btn btn-danger" onclick="if(confirm('Are you sure to delete this schedule?') == false) event.preventDefault();">Delete</button>
                                </form>
                            </td>  
                        </tr>
                        
                    <?php }
                
                    }else{ ?>
                        <h4 for="no records">No records found.</h4>
                <?php   } 
                    //close the stmt
                    mysqli_stmt_close($stmt);
                    //close the database connection
                    mysqli_close($dbConnect); ?>
                </table>
            </div>
            <?php }else{
                echo "<script>
                    alert('Unauthorized page! Please login with valid credentials. Thank you!')
                    window.location.href='../index.php';
                </script>";
                exit();
             } ?>
       </div> 
    </div>
</main>

<?php
include('adminfooter.php');
?>
