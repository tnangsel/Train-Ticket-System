<?php
include('../Authentication/connection.php');
include('../header.php');
?>

<style>

    .welcome {
        background-size: cover;
        min-height: 100vh;
        
        position: relative;
        color: white;
        text-shadow: 3px 3px 3px rgba(0, 0, 0, .2);
    }
    h1{
        font-size: 4rem;
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
        h1 {
            font-size: 0.75rem;
        }

    } 

    .card {
        width: 40rem;
        height: 40rem;
        background-color: lightgrey;
        border: 1px solid #ccc;
        border-radius: 15px;
        margin: 0 auto;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    form {
        display: flex;
        flex-direction: column;
    }

    input {
        margin-bottom: 1rem;
        padding: 1rem;
        border-radius: 10px;
        border: 1px solid #ccc;
    }

    input[type="submit"] {
        background-color: #4CAF50;
        color: #fff;
        cursor: pointer;
    }

</style>

<main> 
    <div class="welcome" style="background-image: url('../img/trainstation.jpg');">
        <div class="overlay d-flex justify-content-center align-items-center">
        <?php if($_SESSION['type'] == 'admin'){ ?>
            <div class="card">
                <form>
                    <input type="text" placeholder="Enter your name">
                    <input type="email" placeholder="Enter your email">
                    <a href="test.php"><button type="button" >Submit</button></a>
                </form>
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