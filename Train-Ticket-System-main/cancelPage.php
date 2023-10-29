<?php
include('header.php');
require 'phpmailer/PHPMailerAutoload.php';
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
            font-size: calc(1.525rem + 3.3vh);
        }

    } 

</style>
<main> 
    <div class="welcome" style="background-image: url('../railway.jpg');">
        <div class="overlay d-flex justify-content-center align-items-center">
            
                <h1>Something went wrong. Please try again.</h1>
            <?php
                echo "<script>
                alert('Payment failure. Please make sure your card number matches or try with different credit card.')
                window.location.href='/TrainTicketWebApp/User/book.php';
                </script>"; ?>
            
            
            
            
       </div> 
    </div>
</main>

<?php
include('footer.php');
?>
    
