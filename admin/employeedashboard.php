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

<div class="row justify-content">
<div class = "col-lg-4">
<form action='employeedashboard.php' method='post' id='employee'>
     <table class='table table-responsive'>
        <tr>
            <td class='width-30-percent'>Firstname</td>
            <td><input type='text' name='firstname' class='form-control' required value="<?php echo isset($_POST['firstname']) ? htmlspecialchars($_POST['firstname'], ENT_QUOTES) : "";  ?>" /></td>
        </tr> 
            <td>Lastname</td>
            <td><input type='text' name='lastname' class='form-control' required value="<?php echo isset($_POST['lastname']) ? htmlspecialchars($_POST['lastname'], ENT_QUOTES) : "";  ?>" /></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type='email' name='email' class='form-control' required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES) : "";  ?>" /></td>
        </tr>
        <tr>
    <td>Department</td>
    <td> <select name="department"  class='form-control' required value="<?php echo isset($_POST['department']) ? htmlspecialchars($_POST['department'], ENT_QUOTES) : "";  ?>" >
    <option value="CSR">CSR</option>
    <option value="Orders">Orders</option>
    <option value="Tech">Tech</option>
    <option value="Processing">Processing</option>
    <option value="Escalation">Escalations</option>
  </select>
  </td>
        </tr>
             <td></td>
                <td>
                <button name ="submit" type="submit" class="btn btn-primary">
                    <span class="glyphicon glyphicon-floppy-disk"> SAVE </span> 
                </button>
            </td>
        </tr> 
    </table>
</form>
</div> <!-- col end-->
</div><!-- row end-->

 <?php 
// include page footer HTML
include_once "layout_foot.php";


?>
