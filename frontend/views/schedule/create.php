<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Schedule */
/* @var $stationList [] */
/* @var $carrierList [] */
/* @var $days [] */

$this->title = Yii::t('schedule', 'Create Schedule');
$this->params['breadcrumbs'][] = ['label' => Yii::t('schedule', 'Schedules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="schedule-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'stationList' => $stationList,
        'carrierList' => $carrierList,
        'days' => $days
    ]) ?>

</div>
