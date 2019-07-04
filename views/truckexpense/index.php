<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\TruckexpenseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Truckexpenses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="truckexpense-index">

    <p>
        <?= Html::a('Create Truckexpense', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'date_reported',
            'expenditure',
            'reason:ntext',
            'truck_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
