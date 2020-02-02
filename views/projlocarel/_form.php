<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Location;
use app\models\Project;
use yii\helpers\ArrayHelper;
use yii\jui\AutoComplete;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model app\models\Projlocarel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="projlocarel-form">
<?php
/* dropDownList(ArrayHelper::map(Project::find()
    ->where(['deleted' => 0])->orderBy(['name' => 'ASC'])->all(), 'id', 'name'),
    ['prompt' => 'Project Name', 'readonly' => !$model->isNewRecord, 'id'=>'project-id','onchange'=>'showLocationList(this.value)'])
    ->label(false) */
?>
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'project')->widget(AutoComplete::className(), [
        'options' => [
            'class' => 'form-control',
        ],

        'clientOptions' => [
         //   'appendTo'=>'#w2',
            'source' => Project::find()->select(['id as id', 'name as value', 'name as label'])
                ->where(['deleted' => 0])->groupBy('name')->orderBy(['name' => SORT_ASC])->asArray()->all()
            ,
            //'change' => 'function(){$(this).init_charge();}',
            'select' => new JsExpression("function( event, ui ) {
              $(this).val(ui.item.id);
    									$(this).init_id();
            }")
        ],
    ])

   ?>
    <?= $form->field($model, 'project_id')->hiddenInput()->label(false); ?>
<?php
$locations = Location::find()->where(['deleted' => 0])->orderBy(['plant_id'=>'ASC','rate_number' => 'ASC'])->all();
foreach($locations as &$location){
    $location->name = $location->name.'  |  RM'.$location->rate_number.' ('.$location->plant->name.')';
}
?>
    <?= $form->field($model, 'location_id')->dropDownList(ArrayHelper::map($locations, 'id', 'name'),
        ['prompt' => 'Location Name', 'readonly' => !$model->isNewRecord,
            'id'=>'location-id'])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Set', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php $this->registerJsFile('http://code.jquery.com/jquery-migrate-3.0.0.js', ['depends' => [\yii\web\JqueryAsset::className()]])?>
<?php $this->registerJs('
                $.fn.init_id = function(){
                    $("#projlocarel-project_id").val($(this).val());  
                    var e = $(this).val();
                             
                              showLocationList(e);
                              
                };
           
            ')?>
