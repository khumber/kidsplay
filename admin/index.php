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
<span class="mdl-layout-title"><?php echo $page_title ?></span>
<div class="jumbotron jumbotron-fluid">
<div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
  <div class="card-header">Computers</div>
  <div class="card-body">
    <h5 class="card-title">Desktops/Laptops</h5>
    <p class="card-text">GBS Enterprises Computer inventory</p>
  </div>
</div>
<div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
  <div class="card-header">HeadSets</div>
  <div class="card-body">
    <h5 class="card-title">HeadSets/Y-Cords</h5>
    <p class="card-text">GBS Enterprises headsets inventory</p>
  </div>
</div>
<div class="card text-white bg-success mb-3" style="max-width: 18rem;">
  <div class="card-header">Phones</div>
  <div class="card-body">
    <h5 class="card-title">Desk Phones/Cells Phones</h5>
    <p class="card-text">GBS Enterprises telephone inventory</p>
  </div>
</div>
  <hr class="my-4">
  <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
  <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
</div>

<?php
 // include page footer HTML
include_once 'layout_foot.php';
?>
