<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Plant;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Location */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="location-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= Html::beginTag('table', ['class'=>'table table-condensed','style'=>'border-collapse: collapse;']) ?>
    <?= Html::beginTag('tr', []) ?>
    <?= Html::beginTag('td', ['width'=>'20%']) ?>
    <?= $form->field($location, 'plant_id')->dropDownList(ArrayHelper::map(Plant::find()->where(['deleted' => 0])->orderBy(['name' => 'ASC'])->all(), 'id', 'name'))->label(false) ?>
    <?= Html::endTag('td') ?>
    <?= Html::beginTag('td', ['width'=>'20%']) ?>
    <?= $form->field($location, 'name')->textInput(['maxlength' => true,'placeholder'=>'Location name'])->label(false) ?>
    <?= Html::endTag('td') ?>
    <?= Html::beginTag('td', ['width'=>'20%']) ?>
    <?= $form->field($location, 'rate_number')->textInput(['maxlength' => true,'placeholder'=>'Rate'])->label(false) ?>
    <?= Html::endTag('td') ?>
    <?= Html::beginTag('td', ['width'=>'20%']) ?>
    <?= $form->field($location, 'description')->textarea(['rows' => 1,'placeholder'=>'Description'])->label(false) ?>
    <?= Html::endTag('td') ?>
    <?= Html::beginTag('td', ['width'=>'20%']) ?>
    <?= Html::submitButton('Add Location', ['class' => 'btn btn-success']) ?>
    <?= Html::endTag('td') ?>
    <?= Html::endTag('tr') ?>
    <?= Html::endTag('table') ?>
    <?php ActiveForm::end(); ?>

</div>
