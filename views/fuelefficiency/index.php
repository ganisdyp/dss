<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\FuelefficiencySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fuelefficiencies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fuelefficiency-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Fuelefficiency', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'display_month',
            'date_reported',
            'litre_per_m3',
            'rm_per_m3',
            //'summary_status',
            //'truck_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
