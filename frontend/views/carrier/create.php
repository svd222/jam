<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Carrier */

$this->title = Yii::t('carrier', 'Create Carrier');
$this->params['breadcrumbs'][] = ['label' => Yii::t('carrier', 'Carriers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="carrier-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
