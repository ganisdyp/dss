<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= Html::beginTag('table', ['class'=>'table table-condensed','style'=>'border-collapse: collapse;']) ?>
    <?= Html::beginTag('tr', []) ?>
    <?= Html::beginTag('td', ['width'=>'50%','colspan'=>'3']) ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true,'placeholder'=>'Customer name'])->label(false) ?>
    <?= Html::endTag('td') ?>
    <?= Html::endTag('tr') ?>
    <?= Html::beginTag('tr', []) ?>
    <?= Html::beginTag('td', ['width'=>'50%']) ?>
    <?= $form->field($model, 'address')->textArea(['maxlength' => true,'placeholder'=>'Address'])->label(false) ?>
    <?= Html::endTag('td') ?>
    <?= Html::beginTag('td', ['width'=>'25%']) ?>
    <?= $form->field($model, 'phone1')->input('tel',['maxlength' => true,'placeholder'=>'Phone 1'])->label(false) ?>
    <?= Html::endTag('td') ?>
    <?= Html::beginTag('td', ['width'=>'25%']) ?>
    <?= $form->field($model, 'phone2')->input('tel',['maxlength' => true,'placeholder'=>'Phone 2'])->label(false) ?>
    <?= Html::endTag('td') ?>
    <?= Html::endTag('tr') ?>
    <?= Html::beginTag('tr', []) ?>
    <?= Html::beginTag('td', ['width'=>'50%']) ?>
    <?= Html::submitButton('Update Customer', ['class' => 'btn btn-success']) ?>
    <?= Html::endTag('td') ?>
    <?= Html::endTag('tr') ?>
    <?= Html::endTag('table') ?>
    <?php ActiveForm::end(); ?>


</div>
