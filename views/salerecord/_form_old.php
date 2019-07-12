<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Plant;
use app\models\Customer;
use app\models\Grade;
use app\models\Project;
use app\models\Truck;
use app\models\Driver;
use app\models\Salerecord;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Salerecord */
/* @var $form yii\widgets\ActiveForm */
$query = Salerecord::find()->where(['display_date'=>date('Y-m-d'),'deleted'=>0])->orderBy(['batch_no'=>'asc','plant_id'=>'asc','customer_id'=>'asc','grade_id'=>'asc','project_id'=>'asc'])->createCommand()->queryAll();
$numItems = count($query);


        $next_batch_no = $query[$numItems-1]["batch_no"]+1;
        $next_do_no = $query[$numItems-1]["delivery_order_no"]+1;


?>

<div class="salerecord-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= Html::beginTag('div', ['class' => 'row']) ?>
    <?= Html::beginTag('div', ['class' => 'col-md-1']) ?>
    <?= $form->field($model, 'batch_no')->textInput(['maxlength' => true,'value'=>$next_batch_no])->label(false) ?>
    <?= Html::endTag('div') ?>
    <?= Html::beginTag('div', ['class' => 'col-md-1']) ?>
    <?= $form->field($model, 'delivery_order_no')->textInput(['maxlength' => true,'value'=>$next_do_no])->label(false) ?>
    <?= Html::endTag('div') ?>
    <?= Html::beginTag('div', ['class' => 'col-md-2']) ?>
    <?= $form->field($model, 'customer_id')->dropDownList(ArrayHelper::map(Customer::find()->where(['deleted' => 0])->orderBy(['name' => 'ASC'])->all(), 'id', 'name'), ['prompt' => '-Customer-', 'readonly' => !$model->isNewRecord])->label(false) ?>
    <?= Html::endTag('div') ?>
    <?= Html::beginTag('div', ['class' => 'col-md-1']) ?>
    <?= $form->field($model, 'grade_id')->dropDownList(ArrayHelper::map(Grade::find()->where(['deleted' => 0])->orderBy(['name' => 'ASC'])->all(), 'id', 'name'), ['prompt' => '-Grade-', 'readonly' => !$model->isNewRecord])->label(false) ?>
    <?= Html::endTag('div') ?>
       <?= Html::beginTag('div', ['class' => 'col-md-1']) ?>
    <?= $form->field($model, 'project_id')->dropDownList(ArrayHelper::map(Project::find()->where(['deleted' => 0])->orderBy(['name' => 'ASC'])->all(), 'id', 'name'), ['prompt' => '-Project-', 'readonly' => !$model->isNewRecord])->label(false) ?>
    <?= Html::endTag('div') ?>
    <?= Html::beginTag('div', ['class' => 'col-md-1']) ?>
    <?= $form->field($model, 'truck_id')->dropDownList(ArrayHelper::map(Truck::find()->orderBy(['truck_no' => 'ASC'])->all(), 'id', 'truck_no'), ['prompt' => '-Truck-', 'readonly' => !$model->isNewRecord])->label(false) ?>
    <?= Html::endTag('div') ?>
    <?= Html::beginTag('div', ['class' => 'col-md-1']) ?>
    <?= $form->field($model, 'driver_id')->dropDownList(ArrayHelper::map(Driver::find()->orderBy(['name' => 'ASC'])->all(), 'id', 'name'), ['prompt' => '-Driver-', 'readonly' => !$model->isNewRecord])->label(false) ?>
    <?= Html::endTag('div') ?>
    <?= Html::beginTag('div', ['class' => 'col-md-1']) ?>
    <?= $form->field($model, 'm3')->textInput(['maxlength' => true,'placeholder'=>'M3'])->label(false) ?>
    <?= Html::endTag('div') ?>

    <?= Html::beginTag('div', ['class' => 'col-md-1']) ?>
    <?= $form->field($model, 'special_condition')->dropDownList([ 'cancelled' => 'Cancelled', 'trial mix' => 'Trial mix', 'rejected' => 'Rejected', ], ['prompt' => ''])->label(false) ?>
    <?= Html::endTag('div') ?>
    <?= Html::beginTag('div', ['class' => 'col-md-2']) ?>
    <?= $form->field($model, 'remark')->textarea(['rows' => 1,'placeholder'=>'Remark'])->label(false) ?>
    <?= Html::endTag('div') ?>
    <?= Html::endTag('div') ?>

    <div class="form-group">
        <?= Html::submitButton('Save and continue', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
