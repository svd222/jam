<?php
/**
 * Created by PhpStorm.
 * User: svd
 * Date: 12.02.19
 * Time: 19:14
 */
namespace api\controllers;

use api\components\ActiveController;
use common\models\Station;
use yii\helpers\ArrayHelper;
use yii\rest\IndexAction;
use yii\data\ActiveDataProvider;
use Yii;
use yii\web\Response;

class StationController extends ActiveController
{
    /**
     * @var string
     */
    public $modelClass = Station::class;

    public function actions()
    {
        $actions = parent::actions();
        $actions['index'] = [
            'class' => IndexAction::class,
            'modelClass' => $this->modelClass,
            'prepareDataProvider' => function () {
                return new ActiveDataProvider([
                    'query' => $this->modelClass::find(),
                    'pagination' => false,
                ]);
            },
        ];

        return $actions;
    }

    /**
     * Create new set of items [
     *   [int 'id' => string 'name'],
     *  ...
     * ]
     *
     * @return array
     */
    public function actionGetList()
    {
        $stations = $this->modelClass::find()->all();
        $keys = ArrayHelper::getColumn($stations, 'id');
        $values = ArrayHelper::getColumn($stations, 'name');
        return array_combine($keys, $values);;
    }
}