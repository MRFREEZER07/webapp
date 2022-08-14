<?php
require_once 'UserSession.class.php';   
class User
{
    private $conn;

    public function __call($name, $arguments)
    {
        $property = preg_replace("/[^0-9a-zA-Z]/", "", substr($name, 3)); //checks wheater it is atoz or 0to9
        $property = strtolower(preg_replace('/\B([A-Z])/', '_$1', $property)); //change to lower pascalcase to lower case

        if (substr($name, 0, 3) == "get") {
            return $this->_get_data($property);
        } elseif (substr($name, 0, 3) == "set") {
            return $this->_set_data($property, $arguments[0]);
        }
    }



    public function __construct($username)
    {
        $this->conn = Database::getConnection();
        $this->username =$username;
        $this->id =null;
        $sql = "SELECT * FROM `auth` WHERE `username`= '$username' OR `id` = '$username' LIMIT 1";
        $result = $this->conn->query($sql);
        if ($result->num_rows==1) {
            $data = mysqli_fetch_assoc($result);
            $id = $data['id'];

        } else {
            throw new Exception("Username does't exist");
        }
    }


    public static function signup($username, $pass, $email)
    {
        $options = [
            'cost' => 12,
        ];
        $password= password_hash($pass, PASSWORD_BCRYPT, $options);
        $conn =Database::getConnection();

        $query="INSERT INTO `auth` (`username`, `password`, `email`, `active`)
        VALUES ('$username', '$password', '$email', '0');";

        $result =$conn->query($query);
        echo $result;
        if ($result === true) {
            $error = false;
        } else {
            $error= $conn->error;
        }
        return $error;
    }

    public static function login($user, $pass)
    {
        $query = "SELECT * FROM `auth` WHERE `username` = '$user'";
        $conn = Database::getConnection();
        $result = mysqli_query($conn, $query);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            //print_r($row);

            if (password_verify($pass, $row['password'])) {

                /*
                1. Generate Session Token
                2. Insert Session Token
                3. Build session and give session to user.
                */
                  
                
                return $row['username'];
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    //this function helps to retrieve data from the database
    private function _get_data($var)
    {
        $conn = Database::getConnection();
        if (!$conn) {
            throw new Exception("error in connecting db");
        }
        $sql = "SELECT `$var` FROM `users` WHERE `id` = $this->id";

        $result = $conn->query($sql);
        if ($result and $result->num_rows == 1) {
            return $result->fetch_assoc()["$var"];
        } else {
            return null;
        }
    }

    //This function helps to  set the data in the database
    private function _set_data($var, $data)
    {
        $conn = Database::getConnection();
        if ($conn) {
            throw new Exception("error in connecting db");
        }
        $sql = "UPDATE `users` SET `$var`='$data' WHERE `id`=$this->id;";
        if ($conn->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function setDob($year, $month, $day)
    {
        if (checkdate($month, $day, $year)) { //checking data is valid
            return $this->_set_data('dob', "$year.$month.$day");
        } else {
            return false;
        }
    }
}
