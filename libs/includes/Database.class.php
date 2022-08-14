<?php

class Database
{
    public static $conn = null;
    public static function getConnection()
    {
        $config_json = file_get_contents('/var/www/env.json');
        $config = json_decode($config_json, true);
        $database =$config['db_server'];
        $username =$config['db_username'];
        $password =$config['db_password'];
        $server =$config['db_name'];

        if (Database::$conn != null) {
            return Database::$conn;
        } else {
            Database::$conn = new mysqli($database, $username, $password, $server);
            if (!Database::$conn) {
                die("Connection failed: ".mysqli_connect_error());
            } else {
                return Database::$conn;
            }
        }
    }
}
