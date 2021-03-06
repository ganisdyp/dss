<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TruckexpenseSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="truckexpense-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'date_reported') ?>

    <?= $form->field($model, 'display_date') ?>

    <?= $form->field($model, 'spare_part_service') ?>

    <?= $form->field($model, 'cost') ?>

    <?php // echo $form->field($model, 'series_no') ?>

    <?php // echo $form->field($model, 'reason') ?>

    <?php // echo $form->field($model, 'warranty') ?>

    <?php // echo $form->field($model, 'remark') ?>

    <?php // echo $form->field($model, 'truck_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
