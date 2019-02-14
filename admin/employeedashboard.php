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

echo "<div class='col-md-12'>"; 
// set page title
    $page_title = "Employee";
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
    // initialize objects
    $employee = new Employee($db); 
    $stmt = $employee->selectAllEmployee();

   // if form was posted
   if(isset($_POST['submit'])){

    $employee->email=$_POST['email']; 
    // check if email already exists
    if($employee->employeeEmailexists()){
        echo "<div class='alert alert-danger'>";
            echo "The employee email you specified is already registered. Use a different email";
        echo "</div>";
    }
    else{
  
    $employee->firstname=$_POST['firstname'];
    $employee->lastname=$_POST['lastname'];
    $employee->department=$_POST['department'];
    $employee->email=$_POST['email'];
    
// create the user
if($employee->create()){
 
    echo "<div class='alert alert-info'>";
        echo "Employee Successfully Added. <a href='{$home_url}admin/employeedashboard.php'>Add Employee</a>.";
    echo "</div>";
     // empty posted values
    $_POST=array();
}else{
    echo "<div class='alert alert-danger' role='alert'>Unable to Save. Please try again.</div>";
}
}
}
//include_once "employee_search.php";
?>

<h2><? $page_title ?></h2>
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">General</a></li>
    <li><a data-toggle="tab" href="#menu1">Account</a></li>
  </ul>
  <div class="tab-content">
    <div id="home" class="tab-pane fade in active panel-body">
        <?php include_once "newemployee.php";?>
    </div>
<div id="menu1" class="tab-pane fade">
      <h3>Menu 1</h3>
      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
 <?php 
// include page footer HTML
include_once "layout_foot.php";
?>
