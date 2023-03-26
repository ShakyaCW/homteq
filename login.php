<?php
session_start();
$pagename="Sign Up"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

echo '<form action="login_process.php" method="post">';
echo '<table>';
echo '<tr>';
echo '<td>Email:</td>';
echo '<td><input type="text" name="email"></td>';
echo '</tr>';
echo '<tr>';
echo '<td>Password:</td>';
echo '<td><input type="password" name="password"></td>';
echo '</tr>';
echo '<tr>';
echo '<td></td>';
echo '<td><input type="submit" value="Login"></td>';
echo '</tr>';
echo '</table>';
echo '</form>';

include("footfile.html"); //include head layout
echo "</body>";
?>