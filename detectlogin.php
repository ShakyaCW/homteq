<?php

// Start the session
session_start();


// Check if user is logged in
if(isset($_SESSION['userid'])) {
  // Get the user's full name from your database 
  $user_id = $_SESSION['userId'];
  
  $conn = new mysqli("localhost", "root", "", "homteq");
  $sql = "SELECT userFName, userLName FROM users WHERE userId = '$user_id'";
  $result = mysqli_query($conn, $sql);

  echo "$user_id";

  $conn->close();
}
?>