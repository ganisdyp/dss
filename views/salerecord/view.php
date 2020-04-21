<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Salerecord */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Salerecords', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="salerecord-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id, 'plant_id' => $model->plant_id, 'customer_id' => $model->customer_id, 'grade_id' => $model->grade_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id, 'plant_id' => $model->plant_id, 'customer_id' => $model->customer_id, 'grade_id' => $model->grade_id], [
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
            'delivery_order_no',
            'batch_no',
            'm3',
            'summary_status',
            'date_created',
            'plant_id',
            'customer_id',
            'grade_id',
            'special_condition',
            'remark:ntext',
            'deleted',
            'truck_id',
            'location_id',
            'driver_id',
        ],
    ]) ?>

</div>
