<?php

include 'header.php';

?>

  
    <style>
   .welcome {
        background-size: cover;
        min-height: 100vh;
        background-position: relative;
        color: white;
        text-shadow: 3px 3px 3px rgba(0, 0, 0, .25);
    }

    h1 {
        font-size: 4rem;
    }

    .overlay {
        position: absolute;
        height: 100%;
        width: 100%;
        background-color: rgba(6, 10, 0, .15);
    }

    @media (max-width: 780){
        .welcome {
            min-height: 60vh;
        }
        h1 {
            font-size: 3rem;
        }

    } 
    .card {
        /* width: 30rem;
        height: 10rem; */
        background-color: transparent !important;
        border: 0px;
        border-radius: 15px;
        margin: 0 auto;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    </style>

  
 
    <main>
        <div class="welcome" style="background-image: url('img/trainstation.jpg');">
            <div class="overlay d-flex justify-content-center align-items-center">
            
                <iframe src="img/UserGuide.pdf" width="60%" height="80%">User Guide</iframe>
            
            </div>
        </div>
    </main>

</body>







<?php
include 'footer.php';
?>