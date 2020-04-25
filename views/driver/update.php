<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Driver */

$this->title = 'Update Driver: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Drivers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view?id='.$model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="driver-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
