<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Carrier */

$this->title = Yii::t('carrier', 'Update Carrier: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('carrier', 'Carriers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('carrier', 'Update');
?>
<div class="carrier-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
