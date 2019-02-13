<?php
// core configuration
include_once "../config/core.php";
// set page title
$page_title="Equipment";
// include login checker
$require_login=true;
include_once "login_checker.php";
//inculde utils function to validate user input 
include_once "../libs/php/utils.php";
 
// include page header HTML
include_once 'layout_head.php';

echo "<div class='col-lg-12'>";
echo "<form class='form_search' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='post'>";
                    echo "<div class='input-group'>";
                    echo "<input type='Text' name='searchText' class='search_text' placeholder='Enter equipment...' required autofocus  />";
                    echo "<button type='submit'><i class='glyphicon glyphicon-search'></i></button>";
                    echo "<button type='button'><i class='glyphicon glyphicon-plus-sign'></i></button>";
                    echo "</form>";
                  
echo "</div>";
echo "</div>";


if($_SERVER["REQUEST_METHOD"]=="POST"){

include_once "../config/database.php";
include_once "../objects/equipment.php";

$utils  = new Utils();
$funcname = 'validate_input';
$searchText_Input = $utils->$funcname($_POST["searchText"]);

// get database connection
$database = new Database();
$db = $database->getConnection();
// initialize objects
$equipment = new Equipment($db);
 
// check if email and password are in the database
//$equipment->searchText=$searchText_Input;

// check search input against the search index
$resultSet = $equipment->getSearchResult();
$num = $resultSet ->rowCount();
echo "<div class='col-md-12'>";
     // to prevent undefined index notice

     echo "MY Count is :".$num;
if($num>0){
 echo "<table class='table table-hover table-responsive table-bordered'>";
     // table headers
    echo "<tr>";
        echo "<th>Description</th>";
        echo "<th>SerialNumber</th>";
        echo "<th>Purchase Date</th>";
        echo "<th>Quantity</th>";
    echo "</tr>";
     // loop through the user records
        while ($row = $resultSet->fetch(PDO::FETCH_ASSOC)){
        extract($row);
 
        // display user details
        echo "<tr>";
            echo "<td>{$description}</td>";
            echo "<td>{$eq_serial_no}</td>";
            echo "<td>{$purchase_date}</td>";
            echo "<td>{$equip_quantity}</td>";
        echo "</tr>";
        }
 
    echo "</table>";
}
}
 
// footer HTML and JavaScript codes
include 'layout_foot.php';
?>