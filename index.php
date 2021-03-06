<?php
// core configuration
include_once "config/core.php";
// set page title
$page_title="Search";
// include login checker
$require_login=true;
include_once "login_checker.php";

//inculde utils function to validate user input 
include_once "libs/php/utils.php";
 
// include page header HTML
include_once 'layout_head.php';

echo "<div class='account-wall'>";
echo "<form class='form_search' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='post'>";
                    echo "<input type='Text' name='searchText' class='search_text' placeholder='Enter first name or last name' required autofocus  />";
                    echo "<button type='submit'><i class='glyphicon glyphicon-search'></i></button>";
                echo "</form>";
echo "</div>";

if($_SERVER["REQUEST_METHOD"]=="POST"){

include_once "config/database.php";
include_once "objects/employee.php";

$utils  = new Utils();
$funcname = 'validate_input';
$searchText_Input = $utils->$funcname($_POST["searchText"]);

// get database connection
$database = new Database();
$db = $database->getConnection();
// initialize objects
$employee = new Employee($db);
 
// check if email and password are in the database
$employee->searchText=$searchText_Input;

// check search input against the search index
$resultSet = $employee->getSearchResult();
$num = $resultSet ->rowCount();
echo "<div class='col-md-12'>";
     // to prevent undefined index notice
if($num>0){
 echo "<table class='table table-hover table-responsive table-bordered'>";
     // table headers
    echo "<tr>";
        echo "<th>Firstname</th>";
        echo "<th>Lastname</th>";
        echo "<th>Department</th>";
    echo "</tr>";
     // loop through the user records
        while ($row = $resultSet->fetch(PDO::FETCH_ASSOC)){
        extract($row);
 
        // display user details
        echo "<tr>";
            echo "<td>{$firstname}</td>";
            echo "<td>{$lastname}</td>";
            echo "<td>{$department}</td>";
        echo "</tr>";
        }
 
    echo "</table>";
}
}
 



  
 
// footer HTML and JavaScript codes
include 'layout_foot.php';
?>