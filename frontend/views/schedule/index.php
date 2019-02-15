<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('schedule', 'Schedules');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="schedule-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('schedule', 'Create Schedule'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'label' => 'Dep station name',
                'value' => 'departureStation.name',
            ],
            [
                'label' => 'Departure Time',
                'value' => function($model) {
                    return gmdate('H:i:s', $model->departure_time);
                }
            ],
//            'departure_time:datetime',
            [
                'label' => 'Arriv station name',
                'value' => 'arrivalStation.name',
            ],
            [
                'label' => 'Arrival Time',
                'value' => function($model) {
                    return gmdate('H:i:s', $model->arrival_time);
                }
            ],
//            'arrival_time:datetime',
            'cost',
            'carrier.name',
            'schedule_by_day_of_week',
            'travelTime',

            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return '<a href="/schedule/'.$model->id.'" title="Просмотр" aria-label="Просмотр" data-pjax="0"><span class="glyphicon glyphicon-eye-open"></span></a>';
                    },
                    'update' => function ($url, $model, $key) {
                        return '<a href="/schedule/update?id='.$model->id.'" title="Редактировать" aria-label="Редактировать" data-pjax="0"><span class="glyphicon glyphicon-pencil"></span></a>';
                    },
                    'delete' => function ($url, $model, $key) {
                        return '';
                    }
                ],
            ],
        ],
    ]); ?>
</div>
