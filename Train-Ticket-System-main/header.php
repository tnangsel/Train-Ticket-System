
<!DOCTYPE html>
<html lang="en">
<?php 
session_start(); 
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Train Ticket System</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        font-family: Georgia, Times, 'Times New Roman', serif;
    }

    #header {
        position: absolute;
        z-index: 10;
        width: 100%;
    }
    .header {
        display: flex;
        justify-content: space-between;
    }

    .navbar {
        position: relative;
        padding: 25px 0;
        background-color: transparent !important;
    }
    .navbar-toggler:focus,
    .navbar-toggler:active,
    .navbar-toggler-icon:active {
        outline: none;
    }

    @media (max-width: 768px) {
        .navbar-collapse {
            background-color: rgba(255, 255, 255, .25);
            border: 1px solid #ccc;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            border-bottom-left-radius: 25px;
            border-bottom-right-radius: 25px;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            z-index: 999;
        }
        .navbar-nav {
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;
        }
    }


    .navbar-nav {
        background-color: lightblue rgba(1.5, 2, 2, 1.25);
    }
    .navbar-brand {
        font-weight: bold;
        font-size: 2rem;
        text-transform: uppercase;
        color: white !important;
        text-shadow: 3px 2px 3px black;
    }

    .nav-item {
        font-weight: 600px;
        text-transform: uppercase;
        padding: 10px;
        text-align: center;
    }

    .nav-link {
        color: black !important;
        background: orange;
        letter-spacing: 1px;
        font-size: 1em;
        font-weight: 700;

        border-radius: 20px;
        border: 2px solid #609;
        padding: 20px; 
        width: 12rem;
        height: 2rem; 
        
    }


    .nav-link:hover {
        color: white !important;
        background-color: rgb(
            <?php echo rand(0, 255); ?>,
            <?php echo rand(0, 255); ?>,
            <?php echo rand(0, 255); ?>,
            <?php echo rand(0, 255); ?>) !important; 
    
        transition: all 0.5s ease 0s;
        border-radius: 20px;
    }

    .profile {
        color: black;
        text-decoration: none;
        text-transform: none !important;
        font-size: 1.5rem;
        position: left;
    }
    
    .dropdown-menu {
        font-weight: 600px;
        text-transform: uppercase;
        padding: 10px;
        text-align: center;
        background-color: rgba(255, 255, 255, 0.5);
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        border-bottom-left-radius: 25px;
        border-bottom-right-radius: 25px;
    }

    .dropdown-item {
        color: black !important;
        background: orange;
        letter-spacing: 1px;
        font-size: 1em;
        font-weight: 700;
        text-align: center;
        border-radius: 20px;
        border: 2px solid #609;
        padding-bottom: 2px; 
        width: 12rem;
        height: 2rem; 
        
    }

    .dropdown-item:hover {
        color: white !important;
        background-color: rgb(
            <?php echo rand(0, 255); ?>,
            <?php echo rand(0, 255); ?>,
            <?php echo rand(0, 255); ?>,
            <?php echo rand(0, 255); ?>) !important; 
    
        transition: all 0.5s ease 0s;
        border-radius: 20px;
    }
    

</style> 

<body>
    <header id="header">
        <div class="container-fluid">
            <nav class="navbar fixed-top navbar-expand-lg navbar-light">
                <div class="container-fluid">
                     <!----------------------------User navbar------------------------>
                    <?php if($_SESSION['type'] == 'user'){ ?>

                    <a href="/TrainTicketWebApp/index.php" class="navbar-brand mt-3"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-train-front-fill me-2" viewBox="0 0 16 16">
  <path d="M10.621.515C8.647.02 7.353.02 5.38.515c-.924.23-1.982.766-2.78 1.22C1.566 2.322 1 3.432 1 4.582V13.5A2.5 2.5 0 0 0 3.5 16h9a2.5 2.5 0 0 0 2.5-2.5V4.583c0-1.15-.565-2.26-1.6-2.849-.797-.453-1.855-.988-2.779-1.22ZM6.5 2h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1 0-1Zm-2 2h7A1.5 1.5 0 0 1 13 5.5v2A1.5 1.5 0 0 1 11.5 9h-7A1.5 1.5 0 0 1 3 7.5v-2A1.5 1.5 0 0 1 4.5 4Zm.5 9a1 1 0 1 1-2 0 1 1 0 0 1 2 0Zm0 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm8 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0Zm-3-1a1 1 0 1 1 0 2 1 1 0 0 1 0-2ZM4 5.5a.5.5 0 0 1 .5-.5h3v3h-3a.5.5 0 0 1-.5-.5v-2ZM8.5 8V5h3a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-3Z"/>
</svg>Train Ticket System</a>
                    <button type="button" class="navbar-toggler" data-bs-toggle="collapse"
                        data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                        aria-label="Toggle Navigation">
                        <span class="navbar-toggler-icon" style="color: white;"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="navbar-nav mt-3">
                            
                            <li class="nav-item mt-2">
                                <a href="/TrainTicketWebApp/User/book.php" class="nav-link align-items-center p-1">Book</a>
                            </li>
                            <li class="nav-item mt-2">
                                <a href="/TrainTicketWebApp/User/myTrip.php" class="nav-link p-1">My Trips</a>
                            </li>
                            <li class="nav-item mt-2">
                                <a href="/TrainTicketWebApp/User/ticket.php" class="nav-link p-1">Tickets</a>
                            </li>
                        </ul>
                        
                        <div class="justify-content-end ms-auto ">
                            <div class="dropdown mt-5">

                                <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle profile mb-3" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-person " viewBox="0 0 16 16">
                                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
                                    </svg>
                                    <strong><?php echo $_SESSION['fname']." ".$_SESSION['lname'] ?></strong>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark text-small" aria-labelledby="dropdownUser1">
                                    <li class="nav-item mt-2">
                                        <a class="dropdown-item" href="/TrainTicketWebApp/User/myUserProfile.php">My Account</a>
                                    </li>
                                    <li class="nav-item mt-2">
                                        <a class="dropdown-item" href="/TrainTicketWebApp/Authentication/logoutScript.php">Sign out</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
            

                    <!----------------------------Admin navbar------------------------>
                    <?php }elseif($_SESSION['type'] == 'admin'){ ?>
                        <a href="/TrainTicketWebApp/index.php" class="navbar-brand mt-3"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-train-front-fill me-2" viewBox="0 0 16 16">
  <path d="M10.621.515C8.647.02 7.353.02 5.38.515c-.924.23-1.982.766-2.78 1.22C1.566 2.322 1 3.432 1 4.582V13.5A2.5 2.5 0 0 0 3.5 16h9a2.5 2.5 0 0 0 2.5-2.5V4.583c0-1.15-.565-2.26-1.6-2.849-.797-.453-1.855-.988-2.779-1.22ZM6.5 2h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1 0-1Zm-2 2h7A1.5 1.5 0 0 1 13 5.5v2A1.5 1.5 0 0 1 11.5 9h-7A1.5 1.5 0 0 1 3 7.5v-2A1.5 1.5 0 0 1 4.5 4Zm.5 9a1 1 0 1 1-2 0 1 1 0 0 1 2 0Zm0 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm8 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0Zm-3-1a1 1 0 1 1 0 2 1 1 0 0 1 0-2ZM4 5.5a.5.5 0 0 1 .5-.5h3v3h-3a.5.5 0 0 1-.5-.5v-2ZM8.5 8V5h3a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-3Z"/>
</svg>Train Ticket System</a> 
                    <!-- <a href="/TrainTicketWebApp/index.php" class="navbar-brand">Train Ticket System</a> -->
                    <button type="button" class="navbar-toggler" data-bs-toggle="collapse"
                        data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                        aria-label="Toggle Navigation">
                        <span class="navbar-toggler-icon" style="color: white;"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="navbar-nav ">
                            <li class="nav-item mt-2">
                                <a href="/TrainTicketWebApp/Admin/manageSchedule.php" class="nav-link align-items-center p-1">Add Schedule</a>
                            </li>
                            <li class="nav-item mt-2">
                                <a href="/TrainTicketWebApp/Admin/realTime.php" class="nav-link align-items-center p-1">RealTime</a>
                            </li>
                            <!-- <li class="nav-item mt-2">
                                <a href="/TrainTicketWebApp/Admin/managePayment.php" class="nav-link align-items-center p-1">Payments</a>
                            </li> -->
                            <li class="nav-item mt-2">
                                <a href="/TrainTicketWebApp/Admin/viewAccount.php" class="nav-link align-items-center p-1">Accounts</a>
                            </li>
                        </ul> 
                        
                        <div class="justify-content-end ms-auto">
                            <div class="dropdown">
                                <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle profile" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-person me-2" viewBox="0 0 16 16">
                                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
                                    </svg>
                                    <strong><?php echo $_SESSION['fname']." ".$_SESSION['lname'] ?></strong>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark text-small" aria-labelledby="dropdownUser1">
                                    <li class="nav-item mt-2">
                                        <a class="dropdown-item" href="/TrainTicketWebApp/Admin/manageProfile.php">My Account</a>
                                    </li>
                                    <li class="nav-item mt-2">
                                        <a class="dropdown-item" href="/TrainTicketWebApp/Authentication/logoutScript.php">Sign out</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <?php }else{ ?>  

                    <!----------------------------General navbar------------------------>
                    
                    <a href="index.php" class="navbar-brand mt-3"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-train-front-fill me-2" viewBox="0 0 16 16">
  <path d="M10.621.515C8.647.02 7.353.02 5.38.515c-.924.23-1.982.766-2.78 1.22C1.566 2.322 1 3.432 1 4.582V13.5A2.5 2.5 0 0 0 3.5 16h9a2.5 2.5 0 0 0 2.5-2.5V4.583c0-1.15-.565-2.26-1.6-2.849-.797-.453-1.855-.988-2.779-1.22ZM6.5 2h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1 0-1Zm-2 2h7A1.5 1.5 0 0 1 13 5.5v2A1.5 1.5 0 0 1 11.5 9h-7A1.5 1.5 0 0 1 3 7.5v-2A1.5 1.5 0 0 1 4.5 4Zm.5 9a1 1 0 1 1-2 0 1 1 0 0 1 2 0Zm0 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm8 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0Zm-3-1a1 1 0 1 1 0 2 1 1 0 0 1 0-2ZM4 5.5a.5.5 0 0 1 .5-.5h3v3h-3a.5.5 0 0 1-.5-.5v-2ZM8.5 8V5h3a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-3Z"/>
</svg>Train Ticket System</a>
                    <button type="button" class="navbar-toggler" data-bs-toggle="collapse"
                        data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                        aria-label="Toggle Navigation">
                        <span class="navbar-toggler-icon" style="color: white;"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="navbar-nav ">
                            <li class="nav-item justify-content-end mt-2">
                                <a href="book.php" class="nav-link align-items-center p-1">Book</a>
                            </li>
                        </ul>
                        <hr>
                        <div class="justify-content-end ms-auto">
                            <ul class="navbar-nav">
                                <li class="nav-item justify-content-end mt-2">
                                    <a href="login.php" class="nav-link p-1"> Login</a>
                                </li>
                                <li class="nav-item justify-content-end mt-2">
                                    <a href="signup.php" class="nav-link p-1"> Signup</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </nav>
        </div>
    </header>