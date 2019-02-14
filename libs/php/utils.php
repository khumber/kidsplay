<?php


class Utils{
private $conn;

   // constructor
   public function __construct($db){
    $this->conn = $db;
}

   
    function validate_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      } 
      
      
     function  countTableTotal()
     {
     $table_array= array('users','employee','equipment');
     foreach($table_array as $table_name )
     {
              // query to select all user records
             $query = 'SELECT * FROM ' .$table_name;          
             // prepare query statement
             $stmt = $this->conn->prepare($query);          
             // execute query
             $stmt->execute();
             // get number of rows
             $num = $stmt->rowCount();            

             if ($table_name =='users'){
             $_SESSION ['count_all_users'] =$num;
             }
             
             if($table_name =='employee'){
                $_SESSION ['count_all_employee']=$num;
             }
             
             if($table_name =='equipment'){
                $_SESSION ['count_all_equipment'] =$num;
            }
         }

     } 

   function quickDisplayTotals()
   {
    $query = 'SELECT  * FROM equipment where quick_display =1' ;
    $stmt = $this->conn->prepare($query);
    $stmt->execute();  

    $num =$stmt->rowCount();
    return $stmt;
   }
}
?>