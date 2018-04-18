<?php

namespace api\modules\v1\controllers;

use yii\filters\AccessControl;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;

/**
 * Admin Controller API
 *
 */
class AdminController extends ActiveController
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = ['class' => QueryParamAuth::className(),];
        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'rules' => [
                [
                    'actions' => ['index'],
                    'allow' => true,
                    'roles' => ['admin'],
                ],
            ],
        ];
        return $behaviors;
    }

    public
        $modelClass = 'common\models\Country';
}