<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Plant */

$this->title = 'Update Plant: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Plants', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view?id='.$model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="plant-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
