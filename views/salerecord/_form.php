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
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Salerecord */
/* @var $form yii\widgets\ActiveForm */
$query = Salerecord::find()->where(['display_date'=>date('Y-m-d'),'deleted'=>0])
    ->orderBy(['batch_no'=>'asc','plant_id'=>'asc','customer_id'=>'asc','grade_id'=>'asc','project_id'=>'asc'])
    ->createCommand()->queryAll();
$query2 = Salerecord::find()->where(['display_date'=>date('Y-m-d'),'deleted'=>0])
    ->orderBy(['delivery_order_no'=>'asc','plant_id'=>'asc','customer_id'=>'asc','grade_id'=>'asc','project_id'=>'asc'])
    ->createCommand()->queryAll();
/*$query = Salerecord::find()->where(['deleted'=>0])
    ->orderBy(['batch_no'=>'desc'])->createCommand()->queryAll();*/
$numItems = count($query);
if($numItems != 0) {
    $next_batch_no = $query[$numItems-1]["batch_no"] + 1;
}else{
    $query = Salerecord::find()->where(['deleted'=>0])
        ->orderBy(['batch_no'=>'asc','plant_id'=>'asc','customer_id'=>'asc','grade_id'=>'asc','project_id'=>'asc'])
        ->createCommand()->queryAll();
    $numItems = count($query);
    $next_batch_no = $query[$numItems-1]["batch_no"] + 1;
}
$numItems2 = count($query2);
if($numItems2 != 0) {
    $next_do_no = $query2[$numItems2-1]["delivery_order_no"] + 1;
}else{
    $query2 = Salerecord::find()->where(['deleted'=>0])
        ->orderBy(['delivery_order_no'=>'asc','plant_id'=>'asc','customer_id'=>'asc','grade_id'=>'asc','project_id'=>'asc'])
        ->createCommand()->queryAll();
    $numItems2 = count($query2);
    $next_do_no = $query2[$numItems2-1]["delivery_order_no"] + 1;
}

?>
<style> #salerecord-form td{
        padding: 0 !important;
        margin:0 !important;
    }</style>
<div class="salerecord-form" id="salerecord-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= Html::beginTag('table', ['class'=>'table table-condensed','style'=>'border-collapse: collapse;']) ?>
    <?= Html::beginTag('tr', []) ?>
    <?= Html::beginTag('td', ['width'=>'2%']) ?>
    <?= '#' ?>
    <?= Html::endTag('td') ?>
    <?= Html::beginTag('td', ['width'=>'6%']) ?>
    <?= $form->field($model, 'batch_no')->textInput(['maxlength' => true,'value'=>$next_batch_no])->label(false) ?>
    <?= Html::endTag('td') ?>
    <?= Html::beginTag('td', ['width'=>'6%']) ?>
    <?= $form->field($model, 'delivery_order_no')->textInput(['maxlength' => true,'value'=>$next_do_no])->label(false) ?>
    <?= Html::endTag('td') ?>
    <?= Html::beginTag('td', ['width'=>'18%']) ?>
    <?= $form->field($model, 'customer_id')->dropDownList(ArrayHelper::map(Customer::find()->where(['deleted' => 0])->orderBy(['name' => 'ASC'])->all(), 'id', 'name'), ['prompt' => 'Customer Name', 'readonly' => !$model->isNewRecord, 'id'=>'customer-id'])->label(false) ?>
    <?= Html::endTag('td') ?>
    <?= Html::beginTag('td', ['width'=>'7%']) ?>
    <?= $form->field($model, 'grade_id')->dropDownList(ArrayHelper::map(Grade::find()->where(['deleted' => 0])->orderBy(['name' => 'ASC'])->all(), 'id', 'charac_strength28'), ['prompt' => 'Grade', 'readonly' => !$model->isNewRecord,'id'=>'grade-id'])->label(false) ?>
    <?= Html::endTag('td') ?>
    <?= Html::beginTag('td', ['width'=>'5.5%']) ?>
    <?= $form->field($model, 'm3')->textInput(['maxlength' => true,'placeholder'=>'M3'])->label(false) ?>
    <?= Html::endTag('td') ?>

    <?= Html::beginTag('td', ['width'=>'8%']) ?>
    <?= $form->field($model, 'truck_id')->dropDownList(ArrayHelper::map(Truck::find()->orderBy(['truck_no' => 'ASC'])->all(), 'id', 'truck_no'), ['prompt' => 'Truck', 'readonly' => !$model->isNewRecord,'id'=>'truck-id'])->label(false) ?>
    <?= Html::endTag('td') ?>
    <?= Html::beginTag('td', ['width'=>'8%']) ?>
    <?= $form->field($model, 'driver_id')->dropDownList(ArrayHelper::map(Driver::find()->orderBy(['name' => 'ASC'])->all(), 'id', 'name'), ['prompt' => 'Driver', 'readonly' => !$model->isNewRecord,'id'=>'driver-id'])->label(false) ?>
    <?= Html::endTag('td') ?>
    <?= Html::beginTag('td', ['width'=>'14%']) ?>
    <?= $form->field($model, 'project_id')->widget(DepDrop::classname(), [
        'options' => ['id'=>'project-id'],
        'pluginOptions'=>[
            'depends'=>['customer-id'],
            'placeholder' => 'Project',
            'url' => Url::to(['loadproject'])
        ]
    ])->label(false); ?>
    <?= Html::endTag('td') ?>
    <?= Html::beginTag('td', ['width'=>'10%']) ?>
    <?= $form->field($model, 'special_condition')->dropDownList(['double trip' => 'Double trip','cancelled' => 'Cancelled', 'trial mix' => 'Trial mix', 'rejected' => 'Rejected', ]
        , ['prompt' => 'Special Condition','onchange'=>'validateRemark(this.value);'])->label(false) ?>
    <?= Html::endTag('td') ?>
    <?= Html::beginTag('td', ['width'=>'12%']) ?>
    <?= $form->field($model, 'remark')->textarea(['rows' => 1,'placeholder'=>'Remark'])->label(false) ?>
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
    $('#salerecord-remark').prop('required',true);
}else{
    $('#salerecord-remark').prop('required',false);
}
}

JS;
$this->registerJs($script,\yii\web\View::POS_BEGIN);
?>