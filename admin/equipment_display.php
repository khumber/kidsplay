<?php
     // check if users / customer was logged in
// if user was logged in, show "Edit Profile", "Orders" and "Logout" options
// core configuration
include_once "../config/core.php"; 
// set page title
$page_title = "Equipment"; 
// include login checker
$require_login=true;
include_once "login_checker.php";
 
// include classes
include_once '../config/database.php';
include_once '../objects/equipment.php';
include_once '../libs/php/utils.php';
// include page header HTML
include_once "layout_head.php";

    // get database connection
    $database = new Database();
    $db = $database->getConnection();
    // initialize objects
    $equipment = new Equipment($db); 
   

   // if form was posted
echo "<table class='table table-hover'>";
 // table headers
 echo "<tr>";
 echo '<th class="col">Description</th>';
 echo '<th class="col">Qauntity</th>'; 
 echo '<th class="col">Purchase Date</th>';
 echo "</tr>";
 echo "<tbody>"; 
 $stmt = $equipment->getAllEquipment();
 // loop through the user records
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
     extract($row);
      // display user details
     echo "<tr>";
         echo "<td>{$description}</td>";
         echo "<td>{$equip_quantity}</td>";
         echo "<td>{$purchase_date}</td>";
     echo "</tr>";
     }
  echo "</tbody>";
 echo "</table>";
   ?>

