<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Fuelefficiency */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fuelefficiency-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'display_month')->textInput() ?>

    <?= $form->field($model, 'date_reported')->textInput() ?>

    <?= $form->field($model, 'litre_per_m3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rm_per_m3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'summary_status')->dropDownList([ 'submitted' => 'Submitted', 'pending' => 'Pending', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'truck_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
