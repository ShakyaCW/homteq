<?php
session_start();
include("db.php");
$pagename="Your Login Results"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

// Capture the 2 inputs entered in the form (email and password) using the $_POST superglobal variable
$email = $_POST['email'];
$password = $_POST['password'];

// Display the content of these 2 variables to ensure that the values have been posted properly
echo "Email: " . $email . "<br>";
echo "Password: " . $password;


if(empty($_POST['email']) || empty($_POST['password'])) { //if either mandatory email or password fields in the form are empty
    //Display error "Both email and password fields need to be filled in" message and link to login page
    echo "Both email and password fields need to be filled in. Please go back to the login page and try again.";
    exit;
}
else {
    $email = $_POST['email'];
    $password = $_POST['password'];

    //SQL query to retrieve the record from the users table for which the email matches login email (in form)
    $query = "SELECT * FROM Users WHERE userEmail = '$email'";
    $result = mysqli_query($conn, $query);

    //fetch results of the execution of the SQL query and store them in $arrayu
    $arrayu = mysqli_fetch_assoc($result);

    //also capture the number of records retrieved by the SQL query using function mysqli_num_rows and store it in a variable called $nbrecs
    $nbrecs = mysqli_num_rows($result);

    //if the number of records is 0 (i.e. email retrieved from the DB does not match $email login email in form
    if ($nbrecs == 0) {
        //display error message "Email not recognised, login again"
        echo "Email not recognised, please try again.";
        exit;
    }
    else {
        //if password retrieved from the database (in arrayu) does not match $password
        if ($arrayu['userPassword'] != $password) {
            //display error message "Password not recognised, login again"
            echo "Password not recognised, please try again.";
            exit;
        }
        else {
            //display login success message and store user id, user type, name into 4 session variables i.e.
            //create $_SESSION['userid'], $_SESSION['usertype'], $_SESSION['fname'], $_SESSION['sname'],
            //Greet the user by displaying their name using $_SESSION['fname'] and $_SESSION['sname']
            //Welcome them as a customer by using $_SESSION['usertype ']
            $_SESSION['userId'] = $arrayu['userId'];
            $_SESSION['userType'] = $arrayu['userType'];
            $_SESSION['userFName'] = $arrayu['userFName'];
            $_SESSION['userSName'] = $arrayu['userSName'];

            echo "Welcome, ".$_SESSION['fname']." ".$_SESSION['sname']."! You are now logged in as a ".$_SESSION['usertype'].".";
            exit;
        }
    }
}


echo "</body>";
?>