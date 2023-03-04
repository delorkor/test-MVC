<?php

namespace Test\Test\Controller\Web;

use Test\Test\Model\User;
use Test\Test\Component\View;

class UsersController
{
    public function actionIndex()
    {
        $users = User::getAll();

        View::build(
            'main', // template
            'users', // page
            [
                'users' => $users,
            ]
        );
    }

    public function actionView($userId)
    {
        $users = User::getUser($userId);

        View::build(
            'main', // template
            'users', // page
            [
                'users' => $users,
            ]
        );
        echo 'Привет, это страничка пользователя ID: ' . $userId;
    }
}
