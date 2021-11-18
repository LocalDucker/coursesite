<?php

class UserController
{
    public function actionRegister()
    {

        /*
            Реєстрація
        */

        $name = '';
        $password = '';
        $confirmPassword = '';
        $email = '';
        $adress = '';
        $phoneNumber = '';
        $sex = ''; // присвоюється в перевірці нижче

        $result = false;

        if(isset($_POST['regButt'])) {
            $name = $_POST['name'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirmPassword'];
            $email = $_POST['email'];
            $adress = $_POST['adress'];
            $phoneNumber = $_POST['phoneNumber'];

            $errors = false;
            if (!User::checkName($name)) {
                $errors[] = 'Введіть Ім\'я';
            }
            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль повинен бути більше 3-х символів';
            }
            if (!User::checkConfirmPassword($password, $confirmPassword)) {
                $errors[] = 'Не співпадають паролі';
            }
            if (!User::checkEmail($email)) {
                $errors[] = 'Введіть email';
            }
            if (!User::checkAdress($adress)) {
                $errors[] = 'Введіть адресу';
            }
            if (!User::checkPhoneNumber($phoneNumber)) {
                $errors[] = 'Некоректний номер';
            }
            if (!isset($_POST['radioButton'])) {
                $errors[] = 'Виберіть стать';
            }else{
                $sex = $_POST['radioButton'];
            }
            if(User::checkExistUser($email)){
                $errors[] = 'Такий емайл вже існує';
            }

            if(!$errors){
                $result = User::register($name, $password, $email, $adress, $phoneNumber, $sex);
                $user = User::checkLoginUser($email, $password);
                User::auth($user);

                header("Location: /profile");
            }
        }

        /*
            Авторизація
        */

        $loginEmail = '';
        $loginPassword = '';
        if(isset($_POST['loginButton'])) {

            $loginEmail = $_POST['loginEmail'];
            $loginPassword = $_POST['loginPassword'];


            $loginErrors = false;
            //Присвоюємо змінній user значення id юзера, який залогінився
            $user = User::checkLoginUser($loginEmail, $loginPassword);
            if (!$user) {
                $loginErrors[] = 'Невірні дані';
            }else{
                //Створюємо сесійну змінну user і присвоюємо їй значення юзерАйді, яке отримали з методу checkLoginUser
                User::auth($user);

                header("Location: /profile");
            }
            
        }
        // якщо авторизований, то не перейде на сторінку авторизації
        if (isset($_SESSION['user'])){
            header("Location: /profile");
        }

        require_once(ROOT . '/views/login.php');
        return true;
    }


    public function actionLogout()
    {
        unset($_SESSION['user']);
        header("Location: /login");
    }

    public function actionDelete()
    {
        $userId = User::checkLogged();

        $user = User::deleteAccount($userId);
        if($user){
            $this->actionLogout();
        }
    }
    

}