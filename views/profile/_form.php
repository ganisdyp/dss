<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Plant;
/* @var $this yii\web\View */
/* @var $model app\models\Profile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($user, 'username')->textInput() ?>

    <?= $form->field($user, 'password_hash')->textInput() ?>

    <?//= $form->field($user, 'email')->textInput() ?>

    <?= $form->field($user, 'role')->dropDownList([ '1' => 'PLANT ADMIN', '5' => 'HQ ADMIN', '9' => 'MANAGEMENT'], ['prompt' => '- Select Role -']) ?>

    <?= $form->field($model, 'plant_id')->dropDownList(ArrayHelper::map(Plant::find()->where(['deleted'=>0])->orderBy(['id' => 'ASC'])->all(), 'id', 'name'), ['prompt' => '- Select Plant -', 'readonly' => !$model->isNewRecord]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
