<?php
/**
 * Created by PhpStorm.
 * User: svd
 * Date: 12.02.19
 * Time: 19:14
 */
namespace api\controllers;

use api\components\ActiveController;
use common\models\Schedule;
use yii\rest\IndexAction;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecordInterface;
use yii\web\NotFoundHttpException;
use Yii;

class ScheduleController extends ActiveController
{
    /**
     * @var string
     */
    public $modelClass = Schedule::class;

    public function actions()
    {
        $actions = parent::actions();
        $actions['index'] = [
            'class' => IndexAction::class,
            'modelClass' => $this->modelClass,
            'prepareDataProvider' => function () {
                return new ActiveDataProvider([
                    'query' => $this->modelClass::find()
                        ->with('departureStation')
                        ->with('arrivalStation'),
                    'pagination' => false,
                ]);
            },
        ];

        return $actions;
    }

    public function actionGetDays()
    {
        return Schedule::getDays();
    }
}