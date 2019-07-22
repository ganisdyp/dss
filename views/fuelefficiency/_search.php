<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FuelefficiencySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fuelefficiency-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'display_month') ?>

    <?= $form->field($model, 'date_reported') ?>

    <?= $form->field($model, 'litre_per_m3') ?>

    <?= $form->field($model, 'rm_per_m3') ?>

    <?php // echo $form->field($model, 'summary_status') ?>

    <?php // echo $form->field($model, 'truck_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
