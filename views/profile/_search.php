<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProfileSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'Name') ?>

    <?= $form->field($model, 'date_created') ?>

    <?= $form->field($model, 'Status') ?>

    <?= $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'Username') ?>

    <?php // echo $form->field($model, 'Password') ?>

    <?php // echo $form->field($model, 'Inactive') ?>

    <?php // echo $form->field($model, 'last_accessed') ?>

    <?php // echo $form->field($model, 'plant_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
