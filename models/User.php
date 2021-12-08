<?php

class User
{
    public static function register($name, $password, $email, $adress, $phoneNumber, $sex)
    {
        $db = Db::getConnect();

        $sql = 'INSERT INTO users(name, password, email, adress, phoneNumber,sex)
                VALUES (:name, :password, :email, :adress, :phoneNumber, :sex)';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':adress', $adress, PDO::PARAM_STR);
        $result->bindParam(':phoneNumber', $phoneNumber, PDO::PARAM_STR);
        $result->bindParam(':sex', $sex, PDO::PARAM_STR);

        return $result->execute();
    }

    public static function checkName($name)
    {
        if(strlen($name) >= 1){
            return true;
        }
        return false;
    }

    public static function checkPassword($password)
    {
        if(strlen($password) >= 4){
            return true;
        }
        return false;
    }

    public static function checkConfirmPassword($password, $confirmPassword)
    {
        if($password == $confirmPassword){
            return true;
        }
        return false;
    }

    public static function checkEmail($email)
    {
        if(filter_var($email,FILTER_VALIDATE_EMAIL)){
            return true;
        }
        return false;
    }

    public static function checkAdress($adress)
    {
        if(strlen($adress) != 0){
            return true;
        }
        return false;
    }

    public static function checkPhoneNumber($phoneNumber)
    {
        if(preg_match("^[0-9]{3}[0-9]{3}[0-9]{4}$^", $phoneNumber)){
            return true;
        }
        return false;
    }

    public static function checkExistUser($email)
    {
        $db = Db::getConnect();
        
        $sql = 'SELECT * FROM users WHERE email = :email';
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();
        if($result->rowCount()){
            return true;
        }
        return false;
    }


    public static function checkLoginUser($email, $password)
    {
        $db = Db::getConnect();

        $sql = 'SELECT * FROM users WHERE email = :email AND password = :password';
        
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->execute();

        $user = $result-> fetch();
        if($user){
            return $user['id'];
        }
        return false;
    }

    public static function auth($userId)
    {
        $_SESSION['user'] = $userId;
    }

    public static function checkLogged()
    {
        if(isset($_SESSION['user'])){
            return $_SESSION['user'];
        }
        header("Location: /login");

    }

    public static function getInfo($id)
    {
        $db = Db::getConnect();
        
        $sql = 'SELECT * FROM users WHERE id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_STR);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result-> fetch();
    }

    public static function deleteAccount($id)
    {
        $db = Db::getConnect();
        
        $sql = 'DELETE FROM users WHERE id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_STR);
        return $result->execute();

    }

}