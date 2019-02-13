<?php
// check if users / customer was logged in
// if user was logged in, show "Edit Profile", "Orders" and "Logout" options
// core configuration
include_once "../config/core.php";

// set page title
$page_title = "Employee"; 
// include login checker
$require_login=true;
include_once "login_checker.php";

// include classes
include_once '../config/database.php';
include_once '../objects/employee.php';
include_once '../libs/php/utils.php';
// include page header HTML
include_once "layout_head.php";
// set page title
$page_title = "Employee";
// get database connection
$database = new Database();
$db = $database->getConnection();
// initialize objects
$employee = new Employee($db); 
$stmt = $employee->selectAllEmployee();

echo "<table class='mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp'>";
echo "<table class='table table-fixed>"; 
 // table headers
 echo "<tr>";
 echo '<th class="col">Name</th>';
 echo "</tr>";
 echo "<tbody>";
 // loop through the user records
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
     extract($row);
      // display user details
     echo "<tr>";
         echo "<td>{$firstname}"." -"."{$lastname}</td>";
     echo "</tr>";
     }
  echo "</tbody>";
 echo "</table>";
?>