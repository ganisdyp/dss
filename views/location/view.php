<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Location */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Locations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="location-view">

    <p>
        <?= Html::a('Update', ['update?id='.$model->id.'&plant_id='.$model->plant_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete?id='.$model->id.'&plant_id='.$model->plant_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'plant.name',
            'name',
            'description:ntext',
            'rate_prefix',
            'rate_number',
            'deleted',
        ],
    ]) ?>

</div>
