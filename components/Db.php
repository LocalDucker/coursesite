<?php  

class Db {
    public static function getConnect()
    {
        $path = ROOT . '/config/db_params.php';
        $params = include($path);
        
        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']};";
        try {
            $db = new PDO($dsn, $params['user'], $params['password']);
        } catch (PDOException $e) {
            echo 'Failed connect to DB: ' . $e->getMessage();
        }
        
        return $db;
    }
}

?>
