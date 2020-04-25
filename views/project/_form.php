<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
use app\models\Project;

/* @var $this yii\web\View */
/* @var $model app\models\Project */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="project-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= Html::beginTag('table', ['class'=>'table table-condensed','style'=>'border-collapse: collapse;']) ?>
    <?= Html::beginTag('tr', []) ?>
    <?= Html::beginTag('td', ['width'=>'20%']) ?>
   <!-- --><?/*= $form->field($project, 'name')->textInput(['maxlength' => true,'placeholder'=>'Project name'])->label(false) */?>
    <?= $form->field($project,'name')->widget(AutoComplete::className(), [
        'options' => [
            'class' => 'form-control',
            'maxlength' => true,
            'placeholder'=>'Project name'
        ],

        'clientOptions' => [
            //   'appendTo'=>'#w2',
            'source' => Project::find()->select(['id as id', 'name as value', 'name as label'])
                ->where(['deleted' => 0])->groupBy('name')->orderBy(['name' => SORT_ASC])->asArray()->all()
            ,
            //'change' => 'function(){$(this).init_charge();}',
            'select' => new JsExpression("function( event, ui ) {
              $(this).val(ui.item.value);
    									$(this).init_id();
            }")
        ],
    ])->label(false)?>
    <?= Html::endTag('td') ?>
    <?= Html::beginTag('td', ['width'=>'20%']) ?>
    <?= $form->field($project, 'description')->textarea(['rows' => 1,'placeholder'=>'Description'])->label(false) ?>
    <?= Html::endTag('td') ?>
    <?= Html::beginTag('td', ['width'=>'20%']) ?>
    <?= Html::submitButton('Add Project', ['class' => 'btn btn-success']) ?>
    <?= Html::endTag('td') ?>
    <?= Html::endTag('tr') ?>
    <?= Html::endTag('table') ?>
    <?php ActiveForm::end(); ?>

</div>
