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
        width: 40rem;
        height: 38rem;
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
          
            <div class="card text-center">    
                <div class="signup-form">
                    <form style="max-width: 450px; margin:auto;" action="../TrainTicketWebApp/Authentication/signupScript.php" method="post" enctype="multipart/form-data" autocomplete="on">
                        <fieldset>

                            <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" fill="currentColor" class="bi bi-person-vcard" viewBox="0 0 16 16">
                                <path d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5ZM9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8Zm1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5Z"/>
                                <path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2ZM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96c.026-.163.04-.33.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1.006 1.006 0 0 1 1 12V4Z"/>
                                </svg>
                            <legend><h2>Create your Account</h2></legend>
                            <div class="form-group p-2">
                                <div class="row">
                                    <div class="col"><input type="text" class="form-control" name="first_name" placeholder="First Name" autocomplete="first-name" required="required"></div>
                                    <div class="col"><input type="text" class="form-control" name="last_name" placeholder="Last Name" required="required"></div>
                                </div>        	
                            </div>
                            <div class="form-group p-2">
                                <input type="email" class="form-control" name="email_address" placeholder="Email Address" required="required">
                            </div>
                            <div class="form-group p-2">
                                <input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off" required="required">
                            </div>
                            <div class="form-group p-2">
                                <input type="password" class="form-control" name="passwordRepeat" placeholder="Confirm Password" autocomplete="off" required="required">
                            </div> 
                            <div class="text-center mt-3">Already have an account? 
                                <a href="login.php" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
                                        <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                                    </svg> Sign in
                                </a>
                            </div> <hr>
                            <div class="form-group p-2">
                                <button type="submit" class="btn btn-outline-primary btn-lg btn-block" name="register">Register Now</button>
                            </div>
                        </fieldset>
                        
                    </form> 
                </div>
            </div>
        
    </div>
</div>

<?php
include('footer.php');
?>