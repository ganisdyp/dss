<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProjlocarelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Project-Location Relationship';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projlocarel-index">

     <p>
        <?= Html::a('Create Project-Location Relationship', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'rel_id',
            'location_id',
            'project_id',
            'date_assigned',
            'deleted',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
