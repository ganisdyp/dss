<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Truckexpense */
/* @var $form yii\widgets\ActiveForm */
?>
<style> #truckexpense-form td{
        padding: 0 !important;
        margin:0 !important;
    }</style>
<div class="truckexpense-form" id="truckexpense-form">

    <?php
    $date_arr = explode("-", $month);
    $year = $date_arr[0];
    $month_ = $date_arr[1];
    $days_in_month = cal_days_in_month(CAL_GREGORIAN, $month_, $year);

    $form = ActiveForm::begin(); ?>
    <?= Html::beginTag('table', ['class'=>'table table-condensed','style'=>'border-collapse: collapse;']) ?>
    <?= Html::beginTag('tr', []) ?>
    <?= Html::beginTag('td', ['width'=>'10%']) ?>
    <?= $form->field($model, 'display_date')->widget(DatePicker::class, [
        'options' => ['placeholder' => 'DATE'],
        'removeButton' => false,
        'pluginOptions' => [
                'startDate'=>$month.'-01',
            'todayHighlight' => true,
            'autoclose' => true,
            'format' => 'yyyy-mm-dd',
            'endDate' => $month.'-'.$days_in_month,
        ]
    ])->label(false); ?>
    <?= Html::endTag('td') ?>
    <?= Html::beginTag('td', ['width'=>'16.5%']) ?>
    <?= $form->field($model, 'spare_part_service')->textarea(['rows' => 1,'placeholder'=>'SPARE PART & SERVICE'])->label(false) ?>
    <?= Html::endTag('td') ?>
    <?= Html::beginTag('td', ['width'=>'10%']) ?>
    <?= $form->field($model, 'series_no')->textarea(['rows' => 1,'placeholder'=>'SERIES NO'])->label(false) ?>
    <?= Html::endTag('td') ?>
    <?= Html::beginTag('td', ['width'=>'20%']) ?>
    <?= $form->field($model, 'reason')->textarea(['rows' => 1,'placeholder'=>'REASON / DETAIL'])->label(false) ?>
    <?= Html::endTag('td') ?>
    <?= Html::beginTag('td', ['width'=>'14%']) ?>
    <?= $form->field($model, 'warranty')->textarea(['rows' => 1,'placeholder'=>'WARRANTY'])->label(false) ?>
    <?= Html::endTag('td') ?>
    <?= Html::beginTag('td', ['width'=>'14%']) ?>
    <?= $form->field($model, 'remark')->textarea(['rows' => 1,'placeholder'=>'REMARK'])->label(false) ?>
    <?= Html::endTag('td') ?>
    <?= Html::beginTag('td', ['width'=>'12%']) ?>
    <?= $form->field($model, 'cost')->textInput(['maxlength' => true,'placeholder'=>'COST'])->label(false) ?>
    <?= Html::endTag('td') ?>
    <?= Html::beginTag('td', ['width'=>'10%']) ?>
    <?= Html::submitButton('Add and save', ['class' => 'btn btn-success']) ?>
    <?= Html::endTag('td') ?>
    <?= Html::endTag('tr') ?>

    <?= Html::endTag('table') ?>

    <?php ActiveForm::end(); ?>

</div>

