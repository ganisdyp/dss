<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Grade */

$this->title = 'Update Grade: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Grades', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view?id='.$model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="grade-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
