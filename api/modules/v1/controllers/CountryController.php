<?php

namespace api\modules\v1\controllers;

use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;

/**
 * Country Controller API
 *
 */
class CountryController extends ActiveController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = ['class' => QueryParamAuth::className(),];
        return $behaviors;
    }

    public
        $modelClass = 'common\models\Country';
}