<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Custprojrel */

$this->title = 'Update Customer-Project Relationship: ' . $model->rel_id;
$this->params['breadcrumbs'][] = ['label' => 'Customer-Project Relationship', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->rel_id, 'url' => ['view', 'rel_id' => $model->rel_id, 'project_id' => $model->project_id, 'customer_id' => $model->customer_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="custprojrel-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
