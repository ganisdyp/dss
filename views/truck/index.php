<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use fedemotta\datatables\DataTables;
/* @var $this yii\web\View */
/* @var $searchModel app\models\TruckSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Trucks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="truck-index">

    <p>
        <?= Html::a('Create Truck', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

         //   'id',
            'truck_no',
            'remark:ntext',

            ['class' => 'yii\grid\ActionColumn',  'template' => '{view} {update} {delete}', 'buttons' => [
                'view' => function ($url, $model) {
                    $url = str_replace('/'.$model->id,'?id='.$model->id,$url);
                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                        'title' => Yii::t('app', 'truck-view'),
                    ]);
                },
                'update' => function ($url, $model) {
                    $url = str_replace('/'.$model->id,'?id='.$model->id,$url);
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                        'title' => Yii::t('app', 'truck-update'),
                    ]);
                },
                'delete' => function ($url, $model) {
                    $url = str_replace('/'.$model->id,'?id='.$model->id,$url);
                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                        'title' => Yii::t('app', 'truck-delete'),
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',

                        ],
                    ]);
                }

            ],],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
