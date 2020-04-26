<?php

namespace frontend\controllers\behaviors;

use Yii;
use yii\base\Behavior;

/**
 * Class AccessBehavior
 * @package frontend\controllers\behaviors
 */
class AccessBehavior extends Behavior
{

    /**
     * @return \yii\web\Response
     */
    public function checkAccessOnlyAuthUser()
    {
        if (Yii::$app->user->isGuest) {
            return Yii::$app->controller->redirect('/');
        }
    }

    /**
     * @return \yii\web\Response
     */
    public function checkAccessOnlyGuest()
    {
        if (!Yii::$app->user->isGuest) {
            return Yii::$app->controller->redirect('/');
        }
    }
}