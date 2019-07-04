<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Profile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($user, 'username')->textInput() ?>

    <?= $form->field($user, 'password_hash')->textInput() ?>

    <?= $form->field($user, 'email')->textInput() ?>

    <?= $form->field($user, 'role')->textInput() ?>

    <?= $form->field($model, 'profile_img')->fileInput() ?>

    <?= $form->field($model, 'Name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_created')->textInput() ?>

    <?= $form->field($model, 'Status')->dropDownList([ 'ADMIN' => 'ADMIN', 'USER' => 'USER', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'Username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Inactive')->textInput() ?>

    <?= $form->field($model, 'last_accessed')->textInput() ?>

    <?= $form->field($model, 'plant_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
