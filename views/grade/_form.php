<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Grade */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="grade-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'charac_strength28')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cement_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'specified_slump')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'coarse_agg_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fine_agg_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'admixture')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mix_design_for_cal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'deleted')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
