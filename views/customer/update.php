<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Customer */

$this->title = 'Update Customer: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view?id='.$model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="customer-update">

    <?= $this->render('_update', [
        'model' => $model,
    ]) ?>

</div>
