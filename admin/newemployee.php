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
  </select></td>
        </tr>
                <td>
                <button name ="submit" type="submit" class="btn btn-primary">
                    <span class="glyphicon glyphicon-floppy-disk"> SAVE </span> 
                </button>
            </td>
        </tr> 
    </table>
</form>