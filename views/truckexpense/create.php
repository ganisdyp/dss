<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Truckexpense */

$this->title = 'Monthly Truck Expense';
$this->params['breadcrumbs'][] = ['label' => 'Truckexpenses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="truckexpense-create">

    <?= $this->render('_form', [
        'model' => $model,
        'month' => $month,
    ]) ?>

</div>
