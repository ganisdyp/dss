<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Cashsalerecord */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cashsalerecord-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'batch_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'delivery_order_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'm3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'summary_status')->dropDownList([ 'submitted' => 'Submitted', 'pending' => 'Pending', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'date_created')->textInput() ?>

    <?= $form->field($model, 'plant_id')->textInput() ?>

    <?= $form->field($model, 'customer_id')->textInput() ?>

    <?= $form->field($model, 'grade_id')->textInput() ?>

    <?= $form->field($model, 'special_condition')->dropDownList([ 'double trip' => 'Double trip', 'cancelled' => 'Cancelled', 'trial mix' => 'Trial mix', 'rejected' => 'Rejected', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'remark')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'deleted')->textInput() ?>

    <?= $form->field($model, 'truck_id')->textInput() ?>

    <?= $form->field($model, 'driver_id')->textInput() ?>

    <?= $form->field($model, 'display_date')->textInput() ?>

    <?= $form->field($model, 'project_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
