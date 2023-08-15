<?php
include_once "./database/db_manage.php";
class User
{
    private $db;
    private $table = 'users';


    // user properties
    public $id;
    public $name;
    public $email;
    public $password;
    public $created_at;

    // constructor
    public function __construct()
    {
        $this->db = new Database();
    }

    // create user
    public function register()
    {
        // hash the password
        // create query
        $conn = $this->db->getConnection();

        // validations
        if (empty($this->name) || empty($this->email) || empty($this->password)) {
            header('Location: /register');
            return;
        }
        // clean data
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);

        $query = "INSERT INTO users (name, email, password) VALUES ('$this->name', '$this->email', '$this->password')";

        $result = mysqli_query($conn, $query);
        if ($result) {
            session_start();
            $_SESSION['auth'] = "true";
            $_SESSION['email'] = $this->email;

            // redirect to home page
            header('Location: /');
        } else {
            header('Location: /register');
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: /');
    }

    public function login()
    {
        // create query
        $conn = $this->db->getConnection();

        // validations
        if (empty($this->email) || empty($this->password)) {
            header('Location: /login');
            return;
        }
        // clean data
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));

        $query = "SELECT * FROM users WHERE email='$this->email'";
        $result = mysqli_query($conn, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);

            if (password_verify($this->password, $row['password'])) {
                session_start();
                $_SESSION['auth'] = "true";
                $_SESSION['email'] = $this->email;
                header('Location: /', replace: false);
            } else {
                $this->showAlert('Invalid Credentials', 'danger');
                header('Location: /login');
            }
        } else {
            $this->showAlert('Invalid Credentials', 'danger');
            header('Location: /login');
        }
    }



    private function showAlert($message, $type)
    {
        echo '<script> alert("' . $message . '") </script>';
    }
}
