<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Carrier */

$this->title = Yii::t('station', 'Create Station');
$this->params['breadcrumbs'][] = ['label' => Yii::t('station', 'Stations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="carrier-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
