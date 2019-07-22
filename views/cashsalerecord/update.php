<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cashsalerecord */

$this->title = 'Update Cashsalerecord: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cashsalerecords', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'plant_id' => $model->plant_id, 'customer_id' => $model->customer_id, 'grade_id' => $model->grade_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cashsalerecord-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
