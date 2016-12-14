<?php
class User {
    private $dbHost     = "localhost";
    private $dbUsername = "root";
    private $dbPassword = "cubs";
    private $dbName     = "andytest";
    private $userTbl    = 'users';
    
    function __construct(){
        if(!isset($this->db)){
            // Connect to the database
            $conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
            if($conn->connect_error){
                die("Failed to connect with MySQL: " . $conn->connect_error);
            }else{
                $this->db = $conn;
            }
        }
    }
    
    function checkUser($userData = array()){
        if(!empty($userData)){
            //Check whether user data already exists in database
            $prevQuery = "SELECT * FROM ".$this->userTbl." WHERE fuid = '".$userData['fuid']."'";
            try {
                $prevResult = $this->db->query($prevQuery);
            } catch (Exception $e) {
                error_log("this is the error: " + $e);
            }
            if($prevResult->num_rows > 0){
                //Update user data if already exists
                $query = "UPDATE ".$this->userTbl." SET fname = '".$userData['fname']."', lname = '".$userData['lname']."', email = '".$userData['email']."' WHERE fuid = '".$userData['fuid']."'";
                $update = $this->db->query($query);
            }else{
                //Insert user data
                error_log("before insert");
                $query = "INSERT INTO ".$this->userTbl." SET fuid = '".$userData['fuid']."', fname = '".$userData['fname']."', lname = '".$userData['lname']."', email = '".$userData['email']."', pwd = 'password', contact = 'contact'";
                try {
                    $insert = $this->db->query($query);
                } catch (Exception $e) {
                    error_log("Error here: " + $e);
                }
            }
            
            //Get user data from the database
            $result = $this->db->query($prevQuery);
            $userData = $result->fetch_assoc();
        }
        
        //Return user data
        return $userData;
    }
}
?>