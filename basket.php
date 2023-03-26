<?php
session_start();
include("db.php");
$pagename="Smart Basket"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
include("detectlogin.php");
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

// check if the 'h_prodid' from prodbuy page is set
if (isset($_POST['h_prodid'])) {

  $newprodid= $_POST['h_prodid']; // assigning product id to the variable named 'newprodid'
  $reququantity= $_POST['quantity']; // assigning the quantity of the product user has selected to the variable named 'quantity'

  // echo "<p>Selected product Id: ".$newprodid;
  // echo "<p>Selected quantity: ".$reququantity;
  $_SESSION['basket'][$newprodid]=$reququantity; // adding product id and the quantity requested by the user to the session array as pairs. ($newprodid = $reququantity)

  } else {
    // The user has not added a product to their basket
    // echo "<p>Basket Unchanged</p>";
    // echo "<br>";

  }
  

  // Create a variable to store the total cost of the basket
$total = 0;

// Check if the session array $_SESSION['basket'] is set
if (isset($_SESSION['basket'])) {
  // Create an HTML table to display the content of the shopping basket
  echo '<table>';
  echo '<tr><th>Product Name</th><th>Price</th><th>Quantity</th><th>Subtotal</th><th>Remove products</th></tr>';

  // Loop through the basket session array and display the contents of each item
  foreach ($_SESSION['basket'] as $index => $value) {

    
    // Query the database to retrieve details of the selected product
    $query = "SELECT prodId, prodName, prodPrice FROM product WHERE prodId = $index";
    $result = mysqli_query($conn, $query);
    $arrayp = mysqli_fetch_assoc($result);

    // Calculate the subtotal for this item
    $subtotal = $value * $arrayp['prodPrice'];

    // Add the subtotal to the total cost of the basket
    $total += $subtotal;

    // Display the product details in a new row of the HTML table
    echo '<tr>';
    echo '<td>' . $arrayp['prodName'] . '</td>';
    echo '<td>' . $arrayp['prodPrice'] . '</td>';
    echo '<td>' . $value . '</td>';
    echo '<td>' . $subtotal . '</td>';
    echo '<td>';
    // Create a form with a "REMOVE" button for this item
    echo '<form method="post" action="basket.php">';
    echo '<input type="hidden" name="product_id" value="' . $arrayp['prodId'] . '">'; // assigining the product id as the value of the remove button
    echo '<input type="submit" name="remove" value="REMOVE">';
    echo '</form>';
    echo '</td>';
    echo '</tr>';
  }

  // Display the total cost of the basket
  echo '<tr><td colspan="3">Total:</td><td>' . $total . '</td></tr>';
  echo '</table>';
} else {
  // Display a message if the basket is empty
  echo '<p><br>Your basket is empty.';
}

// Check if the "remove" button was clicked for a product
if (isset($_POST['remove'])) { // here 'remove' is the name of the button in line 63
  $key=$_POST["product_id"]; // getting the value of the button 

  // Remove the product from the basket session array
  unset($_SESSION['basket'][$key]);
  
  // Reload the page to update the basket display
  header('Location: basket.php');
  exit();
}
echo "<br><br>";
echo "<a href=clearbasket.php>Clear Basket</a>"; 

echo "<p><br>New Homteq Customers: ";
echo "<a href=signup.php>Sign Up</a>";

echo "<p><br>Returning Homteq Customers: ";
echo "<a href=login.php>Log in</a>";

include("footfile.html"); //include head layout
echo "</body>";
?>