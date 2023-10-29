<?php
include('header.php');
?>
<style>

    .welcome {
        background-size: cover;
        min-height: 100vh;
        position: relative;
        color: black !important;
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

    .card {
        width: 30rem;
        height: 30rem;
        background-color: rgba(255, 255, 255, 0.5);
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
        margin-bottom: 0.5rem;
        padding: 1rem;
        border-radius: 10px;
        border: 1px solid #ccc;
    }

</style>
<div class="welcome" style="background-image: url('img/railway.jpg');">
    <div class="overlay d-flex justify-content-center align-items-center">
        <div class="card text-center mt-5 mb-5 py-3">
            <form style="max-width: 300px; margin:auto;" action="../TrainTicketWebApp/Authentication/loginScript.php" method="POST" autocomplete="on">
                <fieldset>
                
                        <svg xmlns="http://www.w3.org/2000/svg" width="46" height="46" fill="currentColor" class="bi bi-file-lock2 mb-3" viewBox="0 0 16 16">
                            <path d="M8 5a1 1 0 0 1 1 1v1H7V6a1 1 0 0 1 1-1zm2 2.076V6a2 2 0 1 0-4 0v1.076c-.54.166-1 .597-1 1.224v2.4c0 .816.781 1.3 1.5 1.3h3c.719 0 1.5-.484 1.5-1.3V8.3c0-.627-.46-1.058-1-1.224z"/>
                            <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/>
                        </svg>
                    <legend>
                        <h3 class="font-weight-normal mb-3">Please Login</h3>
                    </legend>
                        <label for="emailAddress" class="sr-only" type="hidden"></label>
                            <input type="email" name="email" placeholder="Email Address" class="form-control" required autofocus>

                        <label for="password" class="sr-only" type="hidden"></label>
                            <input type="password" name="password" placeholder="Password" autocomplete="off" class="form-control" required autofocus>
                        <div class="text-center mt-4">Don't have an account? <a href="signup.php">Register Here</a></div>
                        <hr>
                        <div class="mt-3">
                            <button class="btn btn-lg btn-outline-success btn-block" name="login">Sign In</button> 
                        </div>
                </fieldset>
            </form> 
        </div>
    </div>
</div>

<?php
include('footer.php');
?>