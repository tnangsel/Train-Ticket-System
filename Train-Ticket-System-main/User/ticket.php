<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('../Authentication/connection.php');
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

    .overlay {
        position: absolute;
        height: 100%;
        width: 100%;
        background-color: rgba(0, 0, 0, .2);
    }

    .main {
        position: absolute;
        height: auto;
        width:100%;
        margin-top: 10rem;
        margin-bottom: 10rem;
        margin-left: 5rem;
        margin-right: 5rem;
    }
    h5 {
        height: 3rem;
        font-size: 2rem;
        text-align: left;
        text-align: center;
        border-radius: 5px;
        background-color: blue;
    }
     .accordion-button {
        background-color: lightblue !important;
        height: 6rem;
        margin-bottom: 1rem;
        
    }
    .accordion-body {
     
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
    }
    .content {
        font-size: 1.5rem;
        
    }
    
</style>
<main> 
    <div class="welcome" style="background-image: url('../img/railway.jpg');">
        <div class="overlay d-flex justify-content-center align-items-center">
            <div class="container">
                
            <?php if($_SESSION['type'] == 'user'){ 
                $user_id = $_SESSION['user_id'];
                
                $query = "SELECT * FROM tickets WHERE id = $user_id";

                $stmt = mysqli_prepare($dbConnect, $query);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                
                        ?>
                        <div class="card-title text-white"><h5>My Trip Tickets</h5></div>
                        <div class="accordion">
                            <?php
                          
                            while($row = mysqli_fetch_assoc($result)){
                                $qrImage = $row['qr_code'];
                                
                            ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_<?php echo $row['ticket_id']; ?>" aria-expanded="false" aria-controls="collapse_<?php echo $row['ticket_id']; ?>">
                                    <p class="fs-2 fw-bold">Ticket Number: <?php echo $row['ticket_id']; ?></p>
                                </button>
                                </h2>
                                <div id="collapse_<?php echo $row['ticket_id']; ?>" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent=".accordion">
                                <div class="accordion-body">
                                    <ul>
                                    <li class="content">QR code: <br><img src="<?php echo $row['qr_code']; ?>" alt="QR Code" width="200" height="200" style="border: 1px solid black;"></li>
                                    </ul>
                                </div>
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                        </div>

            <?php 
               
        }else{
            echo "<script>
                alert('Unauthorized page! Please login with valid credentials. Thank you!')
                window.location.href='../index.php';
            </script>";
            
            } ?>
            </div>
       </div> 
    </div>
</main>

<?php
include('userfooter.php');
?>