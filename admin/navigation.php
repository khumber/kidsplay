<!-- navbar -->

<header class="navbar navbar-expand-md navbar-dark bg-dark">
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
<a class="navbar-brand" href="<?php echo $home_url; ?>admin/index.php">KidsPlay</a>
 <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo $home_url; ?>admin/index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link"  href="<?php echo $home_url; ?>admin/equipment_display.php">Inventory</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $home_url; ?>admin/read_users.php">User</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?php echo $home_url; ?>admin/employeedashboard.php">Employee</a>
      </li>

      </ul>
      <ul class ="navbar-nav mr-auto" style ="float:right">
      <li class="pull-right">
      <a class="nav-link" > <?php echo ' '. $_SESSION['firstname'].' '.$_SESSION['lastname']; ?></a>
      </li>
      <li class="pull-right">    
        <a class="nav-link" href="<?php echo $home_url; ?>logout.php"> | Logout</a>
      </li>
</ul>
    
  </div>
 </header>




