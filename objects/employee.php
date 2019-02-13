<?php
// 'user' object
class Employee{
 
    // database connection and table name
    private $conn;
    private $table_name = "employee";
 
    // object properties
    public $id;
    public $firstname;
    public $lastname;
    public $department;
    public $email;
    public $searchText;

    // constructor
    public function __construct($db){
        $this->conn = $db;
    }

//-----------------------------------------------------------------------
     // check if given email exist in the database
function employeeEmailexists(){
 
    // query to check if email exists
    $query = "SELECT employee_email
            FROM " . $this->table_name . "
            WHERE employee_email = ?
            LIMIT 0,1";
 
    // prepare the query
    $stmt = $this->conn->prepare( $query );
 
    // sanitize
    $this->email=htmlspecialchars(strip_tags($this->email));
 
    // bind given email value
    $stmt->bindParam(1, $this->email);
 
    // execute the query
    $stmt->execute();
 
    // get number of rows
    $num = $stmt->rowCount();
 
    // if email exists,return true
    if($num>0){
        return true;
    }
     // return false if email does not exist in the database
    return false;
}


//--------------------------------------------------------------------------------------
    function create()
    {

        $query = "INSERT INTO
                " . $this->table_name . "
            SET 
                firstname = :firstname,
                lastname = :lastname,
                department = :department,
                employee_email       = :email";

           // prepare the query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->firstname=htmlspecialchars(strip_tags($this->firstname));
    $this->lastname=htmlspecialchars(strip_tags($this->lastname));
    $this->department=htmlspecialchars(strip_tags($this->department));
    $this->email=htmlspecialchars(strip_tags($this->email));
     
        // bind the values
    $stmt->bindParam(':firstname', $this->firstname);
    $stmt->bindParam(':lastname', $this->lastname);
    $stmt->bindParam(':department', $this->department);
    $stmt->bindParam(':email', $this->email);

        // execute the query, also check if query was successful
        if($stmt->execute()){
            return true;
        }else{
            $this->showError($stmt);
            return false;
        }

    }

//------------------------------------------------------------------------------------
    function getSearchResult()
    {
        $query = "SELECT * FROM ". $this->table_name ." WHERE MATCH(firstname, lastname)
        AGAINST(? IN NATURAL LANGUAGE MODE)";

        $stmt = $this->conn->prepare( $query );
        $this->searchText =htmlspecialchars(strip_tags($this->searchText));

        $stmt->bindParam(1, $this->searchText);
        $stmt->execute();
        return $stmt;
    }

//----------------------------------------------------------------------------------------
    public function showError($stmt){
        echo "<pre>";
            print_r($stmt->errorInfo());
        echo "</pre>";
    }

//----------------------------------------------------------------------------------------
function selectAllEmployee(){
 
    // query to check if email exists
    $query = "SELECT *
            FROM " . $this->table_name ;
 
    // prepare the query
    $stmt = $this->conn->prepare( $query );
 
    // sanitize
    $this->email=htmlspecialchars(strip_tags($this->email));
 
    // bind given email value
    $stmt->bindParam(1, $this->email);
 
    // execute the query
    $stmt->execute();

    return $stmt;
    }

}