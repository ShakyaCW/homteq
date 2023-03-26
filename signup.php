<?php
session_start();
$pagename="Sign Up"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

echo "<form action='signup_process.php' method='post'>";
echo "<table>";
echo "<tr>";
echo "<td>First Name:</td>";
echo "<td><input type='text' name='first_name' required></td>";
echo "</tr>";
echo "<tr>";
echo "<td>Last Name:</td>";
echo "<td><input type='text' name='last_name' required></td>";
echo "</tr>";
echo "<tr>";
echo "<td>Address:</td>";
echo "<td><input type='text' name='address' required></td>";
echo "</tr>";
echo "<tr>";
echo "<td>Postcode:</td>";
echo "<td><input type='text' name='postcode' required></td>";
echo "</tr>";
echo "<tr>";
echo "<td>Tel No:</td>";
echo "<td><input type='text' name='telno'></td>";
echo "</tr>";
echo "<tr>";
echo "<td>Email Address:</td>";
echo "<td><input type='text' name='email'></td>";
echo "</tr>";
echo "<tr>";
echo "<td>Password:</td>";
echo "<td><input type='password' name='password'></td>";
echo "</tr>";
echo "<tr>";
echo "<tr>";
echo "<td>Confirm Password:</td>";
echo "<td><input type='password' name='conpassword'></td>";
echo "</tr>";
echo "<tr>";
echo "<td></td>";
echo "<td><input type='submit' value='Register'></td>";
echo "</tr>";
echo "</table>";
echo "</form>";

echo "</body>";
?>