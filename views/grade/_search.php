<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GradeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="grade-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'charac_strength28') ?>

    <?= $form->field($model, 'cement_type') ?>

    <?= $form->field($model, 'specified_slump') ?>

    <?php // echo $form->field($model, 'coarse_agg_type') ?>

    <?php // echo $form->field($model, 'fine_agg_type') ?>

    <?php // echo $form->field($model, 'admixture') ?>

    <?php // echo $form->field($model, 'mix_design_for_cal') ?>

    <?php // echo $form->field($model, 'deleted') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
