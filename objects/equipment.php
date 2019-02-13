<?php
// 'user' object
class Equipment{
 
    // database connection and table name
    private $conn;
    private $table_name = "equipment";
 
    // object properties
    public $equid_id;
    public $description;
    public $eq_serial_no;
    public $purchase_date;
    public $equip_quantity;

    public $searchText;

    // constructor
    public function __construct($db){
        $this->conn = $db;
    }

    function create()
    {
        $query = "INSERT INTO
                " . $this->table_name . "
            SET 
                description = :description,
                eq_serial_no = :eq_serial_no,
                purchase_date = :purchase_date,
                equip_quantity=equip_quantity";

           // prepare the query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->description=htmlspecialchars(strip_tags($this->description));
    $this->eq_serial_no=htmlspecialchars(strip_tags($this->eq_serial_no));
    $this->purchase_date=htmlspecialchars(strip_tags($this->purchase_date));
    $this->equip_quantity=htmlspecialchars(strip_tags($this->equip_quantity));
        // bind the values
    $stmt->bindParam(':description', $this->description);
    $stmt->bindParam(':eq_serial_no', $this->eq_serial_no);
    $stmt->bindParam(':purchase_date', $this->purchase_date);
    $stmt->bindParam(':equip_quantity', $this->equip_quantity);
        // execute the query, also check if query was successful
        if($stmt->execute()){
            return true;
        }else{
            $this->showError($stmt);
            return false;
        }
    }

    function getAllEquipment()
    {
        $query = "SELECT 
                   description,
                   eq_serial_no,
                   purchase_date, 
                   equip_quantity 
        FROM ". $this->table_name ." 
        ORDER BY description Desc";

       
    $stmt = $this->conn->prepare( $query );
     //   $this->searchText =htmlspecialchars(strip_tags($this->searchText));
    //    $stmt->bindParam(1, $this->searchText);
      //  $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
      //  $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }


    public function showError($stmt){
        echo "<pre>";
            print_r($stmt->errorInfo());
        echo "</pre>";
    }
}