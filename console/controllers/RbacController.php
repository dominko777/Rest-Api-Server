<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
use common\models\User;

class RbacController extends Controller
{

    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();

        $admin = $auth->createRole('admin');
        $user = $auth->createRole('user');

        $auth->add($admin);
        $auth->add($user);

        $dashboard = $auth->createPermission('admin-panel');
        $dashboard->description = 'Admin panel';
        $auth->add($dashboard);
        $auth->addChild($user, $dashboard);

        $auth->assign($admin, 3);
        $auth->assign($user, 2);
    }
}