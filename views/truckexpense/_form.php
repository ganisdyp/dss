<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Truckexpense */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="truckexpense-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date_reported')->textInput() ?>

    <?= $form->field($model, 'expenditure')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reason')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'truck_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
