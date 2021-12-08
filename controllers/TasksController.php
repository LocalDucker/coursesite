<?php

class TasksController
{
    public function actionTask()
    {
        require_once(ROOT . '/views/tasks.php');
        return true;
    }

}