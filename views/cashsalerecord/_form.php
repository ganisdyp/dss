<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Plant;
use app\models\Customer;
use app\models\Grade;
use app\models\Project;
use app\models\Truck;
use app\models\Driver;
use app\models\Cashsalerecord;
use yii\helpers\ArrayHelper;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Salerecord */
/* @var $form yii\widgets\ActiveForm */


?>
<style> #cashsalerecord-form td{
        padding: 0 !important;
        margin:0 !important;
    }</style>
<div class="cashsalerecord-form" id="cashsalerecord-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= Html::beginTag('table', ['class'=>'table table-condensed','style'=>'border-collapse: collapse;']) ?>
    <?= Html::beginTag('tr', []) ?>
    <?= Html::beginTag('td', ['width'=>'2%']) ?>
    <?= '#' ?>
    <?= Html::endTag('td') ?>
    <?= Html::beginTag('td', ['width'=>'6%']) ?>
    <?= $form->field($model2, 'batch_no')->textInput(['maxlength' => true])->label(false) ?>
    <?= Html::endTag('td') ?>
    <?= Html::beginTag('td', ['width'=>'6%']) ?>
    <?= $form->field($model2, 'delivery_order_no')->textInput(['maxlength' => true])->label(false) ?>
    <?= Html::endTag('td') ?>
    <?= Html::beginTag('td', ['width'=>'18%']) ?>
    <?= $form->field($model2, 'customer_id')->dropDownList(ArrayHelper::map(Customer::find()->where(['deleted' => 0])->orderBy(['name' => 'ASC'])->all(), 'id', 'name'), ['prompt' => 'Customer Name', 'readonly' => !$model2->isNewRecord, 'id'=>'customer-id-cashsale'])->label(false) ?>
    <?= Html::endTag('td') ?>
    <?= Html::beginTag('td', ['width'=>'7%']) ?>
    <?= $form->field($model2, 'grade_id')->dropDownList(ArrayHelper::map(Grade::find()->where(['deleted' => 0])->orderBy(['name' => 'ASC'])->all(), 'id', 'charac_strength28'), ['prompt' => 'Grade', 'readonly' => !$model2->isNewRecord,'id'=>'grade-id'])->label(false) ?>
    <?= Html::endTag('td') ?>
    <?= Html::beginTag('td', ['width'=>'5.5%']) ?>
    <?= $form->field($model2, 'm3')->textInput(['maxlength' => true,'placeholder'=>'M3'])->label(false) ?>
    <?= Html::endTag('td') ?>

    <?= Html::beginTag('td', ['width'=>'8%']) ?>
    <?= $form->field($model2, 'truck_id')->dropDownList(ArrayHelper::map(Truck::find()->orderBy(['truck_no' => 'ASC'])->all(), 'id', 'truck_no'), ['prompt' => 'Truck', 'readonly' => !$model2->isNewRecord,'id'=>'truck-id'])->label(false) ?>
    <?= Html::endTag('td') ?>
    <?= Html::beginTag('td', ['width'=>'8%']) ?>
    <?= $form->field($model2, 'driver_id')->dropDownList(ArrayHelper::map(Driver::find()->orderBy(['name' => 'ASC'])->all(), 'id', 'name'), ['prompt' => 'Driver', 'readonly' => !$model2->isNewRecord,'id'=>'driver-id'])->label(false) ?>
    <?= Html::endTag('td') ?>
    <?= Html::beginTag('td', ['width'=>'14%']) ?>
    <?= $form->field($model2, 'project_id')->widget(DepDrop::classname(), [
        'options' => ['id'=>'project-id-cashsale'],
        'pluginOptions'=>[
            'depends'=>['customer-id-cashsale'],
            'placeholder' => 'Project',
            'url' => Url::to(['loadproject'])
        ]
    ])->label(false); ?>
    <?= Html::endTag('td') ?>
    <?= Html::beginTag('td', ['width'=>'10%']) ?>
    <?= $form->field($model2, 'special_condition')->dropDownList(['double trip' => 'Double trip','cancelled' => 'Cancelled', 'trial mix' => 'Trial mix', 'rejected' => 'Rejected', ]
        , ['prompt' => 'Special Condition','onchange'=>'validateRemark(this.value);'])->label(false) ?>
    <?= Html::endTag('td') ?>
    <?= Html::beginTag('td', ['width'=>'12%']) ?>
    <?= $form->field($model2, 'remark')->textarea(['rows' => 1,'placeholder'=>'Remark'])->label(false) ?>
    <?= Html::endTag('td') ?>
    <?= Html::endTag('td') ?>
    <?= Html::endTag('tr') ?>
    <?= Html::beginTag('tr', []) ?>
    <?= Html::beginTag('td',['colspan'=>'10']) ?>
    <?= Html::endTag('td') ?>
    <?= Html::beginTag('td',['colspan'=>'1']) ?>
    <?= Html::submitButton('Save and continue later', ['class' => 'btn btn-success']) ?>
    <?= Html::endTag('td') ?>
    <?= Html::endTag('tr') ?>
    <?= Html::endTag('table') ?>

    <?php ActiveForm::end(); ?>

</div>
<?php
$script = <<< JS

 function validateRemark(value) {
if(value=='cancelled' || value=='rejected'){
    $('#cashsalerecord-remark').prop('required',true);
}else{
    $('#cashsalerecord-remark').prop('required',false);
}
}

JS;
$this->registerJs($script,\yii\web\View::POS_BEGIN);
?>