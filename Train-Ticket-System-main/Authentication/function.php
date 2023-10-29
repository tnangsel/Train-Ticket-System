<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


require_once('connection.php');
session_start();


function emptyUserInput($fname, $lname, $email, $pwd, $pwdRepeat){
  //Check if any of the input fields are empty
  if (empty($fname) || empty($lname) || empty($email) || empty($pwd) || empty($pwdRepeat)) {
    return true;
  } else {
    return false;
  }
}

function emptyUserInputUpdate($fname, $lname, $email, $pwd){
  //Check if any of the input fields are empty
  if (empty($fname) || empty($lname) || empty($email) || empty($pwd)) {
    return true;
  } else {
    return false;
  }
}
function validName($fname, $lname){
  //User input values must be alphabet letters only. 
  $pattern = '/^[a-zA-Z]*$/';
  if(preg_match($pattern, $fname)){
      return true;
  }
  if(preg_match($pattern, $lname)){
      return true;
  }
  return false;
}

function validEmail($email){
  //Validate user input email address
  if(filter_var($email, FILTER_VALIDATE_EMAIL)){
      return true;
  }else{
      return false;
  }
}

function passwordRule($pwd){
  //Check for minimum length
  if (strlen($pwd) < 6) {
    return false;
  }

  //Check for at least one capital letter and one number
  if(!preg_match("/[a-zA-Z]/", $pwd) || !preg_match("/\d/", $pwd)) {
    return false;
  }

  //Password meets all requirements
  return true;
}


function confirmPwd($pwd, $pwdRepeat){
  //Password match check
  if($pwd === $pwdRepeat){
      return true;
  }else{
      return false;
  }
}

function checkEmailExist($dbConnect, $email) {
  //Prepare a SQL statement to select the user's information from the users table
  $stmt = mysqli_prepare($dbConnect, "SELECT * FROM users WHERE email_address = ?");
  mysqli_stmt_bind_param($stmt, "s", $email);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $user = mysqli_fetch_assoc($result);
  mysqli_stmt_close($stmt);
   
  //Check email address exist in the database.
  if ($user !== null && $user['email_address'] == $email) {
    return true; // user with this email already exist
  } else {
    return false; // user with this email does not exist
  }
}

function registerUser($dbConnect, $fname, $lname, $email, $pwd){
    
    //Check the email already exist in the database
    if(checkEmailExist($dbConnect, $email)){
      return false;
    }
    // Hash the user input password
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (first_name, last_name, email_address, password) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($dbConnect, $query);
    mysqli_stmt_bind_param($stmt, 'ssss', $fname, $lname, $email, $hashedPwd);
    $result = mysqli_stmt_execute($stmt);

    if($result == 1){
        // Registration successful
        return true;
    } else {
        // Registration failed
        return false;
    }
    
}

function loginUser($dbConnect, $email, $pwd) {
    // Prepare a SQL statement to select the user's information from the users table
    $stmt = mysqli_prepare($dbConnect, "SELECT * FROM users WHERE email_address = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);
    
    
    //Check if user email is in the database.
    if ($user['email_address'] == $email) {
        //Verify that the password matches the hashed password in the database
        if (password_verify($pwd, $user['password'])) {
            //Store user information in session
            
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['fname'] = $user['first_name'];
            $_SESSION['lname'] = $user['last_name'];
            $_SESSION['email'] = $user['email_address'];
            $_SESSION['type'] = $user['user_type'];
            $_SESSION['LoggedIn'] = TRUE;

            return true;
        }
    }
    //Email or Password is incorrect, return false
    return false;
}

//==============================================================Admin site functions==============================================================//

function checkEmailTaken($dbConnect, $email, $userId) {
  
  //Prepare a SQL statement to select the user's email already exist with different user
  $stmt = mysqli_prepare($dbConnect, "SELECT * FROM users WHERE email_address = ? AND id <> ?");
  mysqli_stmt_bind_param($stmt, "si", $email, $userId);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $user = mysqli_fetch_assoc($result);
  mysqli_stmt_close($stmt);
   
  //Returen true if it exist else false
  if ($user !== null) {
    return true;
  } else {
    return false; 
  }
}


function updateUser($dbConnect, $user_id, $user_fname, $user_lname, $user_email, $pwd, $user_role){
  
  // Hash the user input password
  $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

  //Prepare the SQL statement
  $stmt = mysqli_prepare($dbConnect, "UPDATE users SET first_name = ?, last_name = ?, email_address = ?, password = ?, user_type = ? WHERE id = ?");
  mysqli_stmt_bind_param($stmt, "sssssi", $user_fname, $user_lname, $user_email, $hashedPwd, $user_role, $user_id);
  if (mysqli_stmt_execute($stmt)) {
    
     //User updated success
     return true;
  } else {
     //Fail to update user
     return false;
  }
}
function updateProfile($dbConnect, $user_id, $user_fname, $user_lname, $user_email, $user_pwd){

  
  // Hash the user input password
  $hashedPwd = password_hash($user_pwd, PASSWORD_DEFAULT);

  //Prepare the SQL statement
  $stmt = mysqli_prepare($dbConnect, "UPDATE users SET first_name = ?, last_name = ?, email_address = ?, password = ? WHERE id = ?");
  mysqli_stmt_bind_param($stmt, "ssssi", $user_fname, $user_lname, $user_email, $hashedPwd, $user_id);
 
  if (mysqli_stmt_execute($stmt)) {
    
  
     // Update session information
     $_SESSION['fname'] = $user_fname;
     $_SESSION['lname'] = $user_lname;
     $_SESSION['email'] = $user_email;

     //User updated success
     return true;
  } else {
     //Fail to update user
     return false;
  }
}
function deleteUser($dbConnect, $user_id){
  //Check the number of admin users in the database
  $result = mysqli_query($dbConnect, "SELECT COUNT(*) FROM users WHERE user_type = 'admin'");
  $user = mysqli_fetch_array($result);
  $num_admins = $user[0];

  // If the user being deleted is the last admin user, forbid the delete operation
  if ($user !== null && $num_admins == 1) {
    echo "<script> 
              alert('Cannot delete the last Admin');
              window.location.href='viewAccount.php';
          </script>";
  } else {
      //Delete user with user_id
      $stmt = mysqli_prepare($dbConnect, "DELETE FROM users WHERE id = ?");
      mysqli_stmt_bind_param($stmt, "i", $user_id);
      if (mysqli_stmt_execute($stmt)) {
        //User deleted if true
        return true; 
      } else {
        //Fail to delete the user
        return false;
      }
  }
}
function adminAddUser($dbConnect, $fname, $lname, $email, $pwd, $type){
    
  //Check the email already exist in the database
  if(checkEmailExist($dbConnect, $email)){
    return false;
  }
  // Hash the user input password
  $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

  $query = "INSERT INTO users (first_name, last_name, email_address, password, user_type) VALUES (?, ?, ?, ?, ?)";
  $stmt = mysqli_prepare($dbConnect, $query);
  mysqli_stmt_bind_param($stmt, 'sssss', $fname, $lname, $email, $hashedPwd, $type);
  $result = mysqli_stmt_execute($stmt);

  if($result == 1){
      // Registration successful
      return true;
  } else {
      // Registration failed
      return false;
  }
  
}

function emptyUserAdd($fname, $lname, $email, $pwd, $type){
  //Check if any of the input fields are empty
  if (empty($fname) || empty($lname) || empty($email) || empty($pwd) || empty($type)) {
    return true;
  } else {
    return false;
  }
}

//------------------------------Train Schedule validation functions--------------------------------//

function trainNo($trainNo){
  if(preg_match('/^[0-9]+$/', $trainNo)){
    return true; //user input is valid
  }else {
    return false; //Invalid input 
  }
}

function validateTrainRoute($t_route){
  //Make sure the input contains only letters and hyphens
  if(!preg_match('/^[a-zA-Z-]+$/', $t_route)) {
    return false;
  }
  //If we get here, the train  is valid and doesn't already exist in the schedules table
  return true;
}

function validateDepartureArrival($departure, $arrival){
  //Make sure both departure and arrival contain only letters
  if(!preg_match('/^[a-zA-Z]+$/', $departure) || !preg_match('/^[a-zA-Z]+$/', $arrival)){
    return false;
  }

  //If we get here, both departure and arrival are valid
  return true;
}

function calculatePrice($duration) {
  // Define the pricing tiers as an associative array,
  // with the duration in minutes as the key and the price as the value.
  $pricingTiers = array(
    60 => 5,
    120 => 10,
    180 => 15,
    240 => 20,
    300 => 25,
    360 => 30,
    420 => 35,
    480 => 40,
    540 => 45,
    600 => 50,
    1200 => 55,
    INF => 100
  );

  // Loop through the pricing tiers and return the price
  // for the first tier whose duration is greater than or equal to the travel duration.
  foreach ($pricingTiers as $tierDuration => $tierPrice) {
    if ($duration <= $tierDuration) {
      return $tierPrice;
    }
  }
}

function trainScheduleAdd($dbConnect, $train_no, $train_route, $train_departure, $train_arrival, $departure_datetime, $arrival_datetime, $price){
 
  $query = "INSERT INTO schedules (train_number, train_route, departure, arrival, departure_datetime, arrival_datetime, price) VALUES (?, ?, ?, ?, ?, ?, ?)";
  $stmt = mysqli_prepare($dbConnect, $query);
  $train_r = strtoupper($train_route);
  $t_depart = strtoupper($train_departure);
  $t_arrival = strtoupper($train_arrival);
  mysqli_stmt_bind_param($stmt, 'isssssi', $train_no, $train_r, $t_depart, $t_arrival, $departure_datetime, $arrival_datetime, $price);
  $result = mysqli_stmt_execute($stmt);
  if($result){
    return true; //Schedule added successfully!
  }else{
    return false; //Fail to add schedule
  }
}

//Kong to implement this if you can.... let Tenzin know. Thanks.

// function paymentInfo($dbConnect, $user_id, $user_email, ....){
//   $query = "INSERT INTO users (first_name, last_name, email_address, password) VALUES (?, ?, ?, ?)";
//   $stmt = mysqli_prepare($dbConnect, $query);
//   mysqli_stmt_bind_param($stmt, 'ssss', $fname, $lname, $email, $hashedPwd);
//   $result = mysqli_stmt_execute($stmt);

//   if($result == 1){
//       // Registration successful
//       return true;
//   } else {
//       // Registration failed
//       return false;
//   }
// }

?>

