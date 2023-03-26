<?php
session_start();
include("db.php");
mysqli_report(MYSQLI_REPORT_OFF);
$pagename="Sign Up Results"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page


  // Capture the 7 inputs entered in the 7 fields of the form using the $_POST superglobal variable
  $first_name = trim($_POST['first_name']);
  $last_name = trim($_POST['last_name']);
  $address = trim($_POST['address']);
  $postcode = trim($_POST['postcode']);
  $telno = trim($_POST['telno']);
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);
  $confirm_password = trim($_POST['conpassword']);

  // Check if any fields in the form were left empty
if (empty($first_name) || empty($last_name) || empty($address) || empty($postcode) || empty($telno) || empty($email) || empty($password) || empty($confirm_password)) {
  echo "<p><b>Your Sign-Up Failed</b></p><br>";
  echo "Please fill out all fields";
  echo "<p><br>Go back to: ";
  echo "<a href=signup.php>Sign Up</a>";
  exit();
}

// Check if the 2 entered passwords match
if ($password != $confirm_password) {
  echo "<p><b>Your Sign-Up Failed</b></p><br>";
  echo "Passwords do not match";
  echo "<p><br>Go back to: ";
  echo "<a href=signup.php>Sign Up</a>";
  exit();
}

// Define a regular expression to validate email address format
$email_regex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$/';

// Check if the email address is in the right format
if (!preg_match($email_regex, $email)) {
  echo "<p><b>Your Sign-Up Failed</b></p><br>";
  echo "Invalid email address format";
  echo "<p><br>Go back to: ";
  echo "<a href=signup.php>Sign Up</a>";
  exit();
}

// Chech if the entered email already in use.
// $sql_check_email = "SELECT * FROM Users WHERE userEmail='$email'";
// $result_check_email = mysqli_query($conn, $sql_check_email);
// if (mysqli_num_rows($result_check_email) > 0) {
//   echo "<p><b>Your Sign-Up Failed</b></p><br>";
//   echo "Email address is already in use";
//   echo "<p><br>Go back to: ";
//   echo "<a href=signup.php>Sign Up</a>";
//   exit(); 
// }


  // Write a SQL query to insert a new user into the users table
  $sql = "INSERT INTO Users (userType, userFName, userSName, userAddress, userPostCode, userTelNo, userEmail, userPassword)
          VALUES ('C', '$first_name', '$last_name', '$address', '$postcode', '$telno', '$email', '$password')";

  // Execute the INSERT INTO SQL query
  if (mysqli_query($conn, $sql)) {
    echo "New user created successfully";
  } else {
      $sql_error_code = mysqli_errno($conn);
      if ($sql_error_code == 1062) {
        echo "<p><b>Your Sign-Up Failed</b></p><br>";
        echo "Email address is already in use";
        echo "<p><br>Go back to: ";
        echo "<a href=signup.php>Sign Up</a>";
        exit(); 
      }
      else if ($sql_error_code == 1064) {
        echo "<p><br><b>Your Sign-Up Failed</b></p><br>";
        echo "<br>Invalid characters in input fields<br>";
        echo "<p><br>Go back to: ";
        echo "<a href=signup.php>Sign Up</a>";
        exit();
      } else {
        echo "Error: " . mysqli_error($conn);
      }
  }

  // Close the database connection
  mysqli_close($conn);



echo "</body>";
?>