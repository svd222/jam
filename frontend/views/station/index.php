<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('station', 'Stations');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="station-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('carrier', 'Create Station'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',

            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return '<a href="/station/'.$model->id.'" title="Просмотр" aria-label="Просмотр" data-pjax="0"><span class="glyphicon glyphicon-eye-open"></span></a>';
                    },
                    'update' => function ($url, $model, $key) {
                        return '<a href="/station/update?id='.$model->id.'" title="Редактировать" aria-label="Редактировать" data-pjax="0"><span class="glyphicon glyphicon-pencil"></span></a>';
                    },
                    'delete' => function ($url, $model, $key) {
                        return '';
                    }
                ],
            ],
        ],
    ]); ?>
</div>
