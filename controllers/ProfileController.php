<?php

class ProfileController
{
    public function actionProfile()
    {
        $userId = User::checkLogged();

        $user = User::getInfo($userId);
        
        require_once(ROOT . '/views/main.php');
        return true;

    }

}