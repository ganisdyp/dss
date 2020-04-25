<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Location */

$this->title = 'Update Location: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Locations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view?id='.$model->id.'&plant_id='.$model->plant_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="location-update">

    <?= $this->render('_update', [
        'model' => $model,
    ]) ?>

</div>
