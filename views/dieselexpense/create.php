<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Dieselexpense */

$this->title = 'Diesel Expense';
$this->params['breadcrumbs'][] = ['label' => 'Dieselexpenses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dieselexpense-create">

       <?= $this->render('_form', [
        'model2' => $model2,
           'month' => $month,
    ]) ?>

</div>
