<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Dieselexpense */
/* @var $form yii\widgets\ActiveForm */
?>
<style> #dieselexpense-form td{
        padding: 0 !important;
        margin:0 !important;
    }</style>
<div id="dieselexpense-form">
    <?php
    $date_arr = explode("-", $month);
    $year = $date_arr[0];
    $month_ = $date_arr[1];
    $days_in_month = cal_days_in_month(CAL_GREGORIAN, $month_, $year);

    $form = ActiveForm::begin(); ?>
    <?= Html::beginTag('table', ['class'=>'table table-condensed','style'=>'border-collapse: collapse;']) ?>
    <?= Html::beginTag('tr', []) ?>
    <?= Html::beginTag('td', ['width'=>'8%']) ?>
    <?= $form->field($model2, 'display_date')->widget(DatePicker::class, [
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
    <?= Html::beginTag('td', ['width'=>'20%']) ?>
    <?= $form->field($model2, 'remark')->textarea(['rows' => 1,'placeholder'=>'REMARK'])->label(false) ?>
    <?= Html::endTag('td') ?>
    <?= Html::beginTag('td', ['width'=>'15%']) ?>
    <?= $form->field($model2, 'litre')->textInput(['maxlength' => true,'placeholder'=>'LITRES'])->label(false) ?>
    <?= Html::endTag('td') ?>
    <?= Html::beginTag('td', ['width'=>'15%']) ?>
    <?= $form->field($model2, 'cost')->textInput(['maxlength' => true,'placeholder'=>'RM'])->label(false) ?>
    <?= Html::endTag('td') ?>
    <?= Html::beginTag('td', ['width'=>'25%']) ?>
    <?= Html::submitButton('Add and save', ['class' => 'btn btn-success']) ?>
    <?= Html::endTag('td') ?>
    <?= Html::endTag('tr') ?>
    <?= Html::endTag('table') ?>

    <?php ActiveForm::end(); ?>

</div>
