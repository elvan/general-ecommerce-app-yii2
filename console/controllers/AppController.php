<?php

namespace console\controllers;

use common\models\User;
use yii\console\Controller;
use yii\helpers\Console;

class AppController extends Controller
{
    public function actionCreateAdminUser($username, $password = null)
    {
        $user = new User();
        $user->firstname = $username;
        $user->lastname = $username;
        $user->email = $username . '@example.com';
        $user->username = $username;
        $user->admin = 1;
        $user->status = User::STATUS_ACTIVE;
        $password = $password ?: \Yii::$app->security->generateRandomString(8);
        $user->setPassword($password);
        if ($user->save()) {
            Console::output("User has been created");
            Console::output("Username: " . $username);
            Console::output("Password: " . $password);
        } else {
            Console::error("User \"$username\" was not created");
            var_dump($user->errors);
        }
    }
}
