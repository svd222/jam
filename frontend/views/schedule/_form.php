<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use trntv\yii\datetime\DateTimeWidget;

/* @var $this yii\web\View */
/* @var $model common\models\Schedule */
/* @var $form yii\widgets\ActiveForm */
/* @var $stationList [] */
/* @var $carrierList [] */
/* @var $days [] */
?>

<div class="schedule-form">

    <div class="container">
        <?php $form = ActiveForm::begin([
            'enableAjaxValidation' => false,
            'enableClientValidation' => false,
            'id' => 'data-form'
        ]); ?>

        <div class="row">
            <div class="col-md-2">
                <?= $form->field($model, 'departure_station_id')->dropDownList($stationList); ?>
            </div>
            <div class="col-md-11"></div>
        </div>

        <div class="row">
            <div class="col-md-3">

                <?php echo $form->field($model, 'departure_time')->widget(DateTimeWidget::class); ?>

            </div>
            <div class="col-md-9"></div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <?= $form->field($model, 'arrival_station_id')->dropDownList($stationList); ?>
            </div>
            <div class="col-md-11"></div>
        </div>

        <div class="row">
            <div class="col-md-3">

                <?php echo $form->field($model, 'arrival_time')->widget(DateTimeWidget::class); ?>

            </div>
            <div class="col-md-9"></div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <?= $form->field($model, 'cost')->textInput() ?>
            </div>
            <div class="col-md-11"></div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <?= $form->field($model, 'carrier_id')->dropDownList($carrierList); ?>
            </div>
            <div class="col-md-11"></div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <?= $form->field($model, 'schedule_by_day_of_week')->dropDownList($days, [
                    'multiple' => true
                ]); ?>
            </div>
            <div class="col-md-11"></div>
        </div>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('schedule', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>


</div>

<?php
    Yii::$app->view->registerJs('
        $("form#data-form input[type=text], form#data-form select").each(function(index) {
            var id = $(this).prop("id");
            id = id.substr("schedule-".length);
            $(this).prop("id",id);
        });  
    ', \yii\web\View::POS_READY);
?>
