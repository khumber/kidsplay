<?php 
// core configuration
include_once "../config/core.php";
include_once "../libs/php/utils.php";
// check if logged in as admin
include_once "login_checker.php"; 
// set page title
$page_title="Inventory DashBoard"; 
// include page header HTML
include "layout_head.php";
include_once "../config/database.php";
// get database connection
$database = new Database();
$db = $database->getConnection();

// initialize objects
$util = new Utils($db);
$util->countTableTotal();
$stmt =$util->quickDisplayTotals();




?>
<?php include_once "getjsondata.php";?>




<span class="mdl-layout-title"><?php echo $page_title ?></span>
<div class="jumbotron jumbotron-fluid">
<h2>GBS Enterprises Equipment Management </h2>      
    <p>Keeping tabs on the company's equipment life cycle</p>
</div> <!-- end  jumbotron -->

<div class="jumbotron jumbotron-fluid">
<div class ="row">
<?php

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
extract($row);
echo' <div class ="col-lg-3 col-md-4">
<div class="'.$row['button_type'].'" style="max-width: 25rem;">
  <div class="card-header">'.$row['title'].'<span class="badge badge-light">'.$row['equip_quantity'].'</span></div>
  <div class="card-body">
    <p class="card-text">'.$row['description'] .'</p>
  </div>
</div>
</div>';
}
?>
</div> <!-- End row -->
</div> <!-- end  jumbotron -->
<?php
 // include page footer HTML
include_once 'layout_foot.php';
?>
