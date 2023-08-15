<?php
class Database{ 
    private $host = "localhost";  
    private $user = "root";  
    private $password = '';  
    private $db_name = "test";  
      
    private $con = null; 
    
    public function __construct(){
        $this->con = mysqli_connect($this->host, $this->user, $this->password, $this->db_name);
        if(!$this->con){
            echo 'Database Connection Error ';
            

        }else{
            $this->consoleLog("Database Connected successfully"); 
            // create user table if doesnot exist
            $sql = "CREATE TABLE IF NOT EXISTS users (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(30) NOT NULL,
                email VARCHAR(50) NOT NULL,
                password VARCHAR(100) NOT NULL,
                reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                )";

            if (mysqli_query($this->con, $sql)) {
                $this->consoleLog("Table users created successfully");
            } else {
                $this->consoleLog("Error creating table: " . mysqli_error(self::$con));
            }
        }
    }

    public function getConnection(){
        return $this->con;
    }

    // create user
    public function createUser($name, $email, $mobile, $password){
        // hash the password
        $password = md5($password);
        $sql = "INSERT INTO users (name, email, mobile, password) VALUES ('$name', '$email', '$mobile', '$password')";
        $result = mysqli_query(self::$con, $sql);
        if($result){
            return true;
        }else{
            return false;
        }
    }
private function consoleLog($message){
        echo "<script>console.log('$message');</script>";
    }
    
}
