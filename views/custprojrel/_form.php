<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Customer;
use app\models\Project;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Custprojrel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="custprojrel-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'customer_id')->dropDownList(ArrayHelper::map(Customer::find()
        ->where(['deleted' => 0])->orderBy(['name' => 'ASC'])->all(), 'id', 'name'),
        ['prompt' => 'Customer Name', 'readonly' => !$model->isNewRecord,
            'id'=>'customer-id','onchange'=>'showProjectList(this.value)'])->label(false) ?>

    <?= $form->field($model, 'project_id')->dropDownList(ArrayHelper::map(Project::find()->where(['deleted' => 0])->orderBy(['name' => 'ASC'])->all(), 'id', 'name'), ['prompt' => 'Project Name', 'readonly' => !$model->isNewRecord, 'id'=>'project-id'])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
