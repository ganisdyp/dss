<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Project */

$this->title = 'Update Project: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view?id='.$model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="project-update">

    <?= $this->render('_update', [
        'model' => $model,
    ]) ?>

</div>
