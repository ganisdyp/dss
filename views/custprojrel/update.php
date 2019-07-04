<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Custprojrel */

$this->title = 'Update Custprojrel: ' . $model->rel_id;
$this->params['breadcrumbs'][] = ['label' => 'Custprojrels', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->rel_id, 'url' => ['view', 'rel_id' => $model->rel_id, 'project_id' => $model->project_id, 'customer_id' => $model->customer_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="custprojrel-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
