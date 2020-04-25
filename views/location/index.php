<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use fedemotta\datatables\DataTables;
/* @var $this yii\web\View */
/* @var $searchModel app\models\LocationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Locations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="location-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //  'id',
            'plant.name',
            'name',
         //   'rate_prefix',
            'rate_number',
            'description:ntext',
            //'deleted',


            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} ',
                'buttons' => [
                    'view' => function ($url, $model) {
                        $url = str_replace('/'.$model->id.'?plant_id='.$model->plant_id,'?id='.$model->id.'&plant_id='.$model->plant_id,$url);
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                            'title' => Yii::t('app', 'location-view'),
                        ]);
                    },
                    'update' => function ($url, $model) {
                        $url = str_replace('/'.$model->id.'?plant_id='.$model->plant_id,'?id='.$model->id.'&plant_id='.$model->plant_id,$url);
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                            'title' => Yii::t('app', 'location-update'),
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        $url = str_replace('/'.$model->id.'?plant_id='.$model->plant_id,'?id='.$model->id.'&plant_id='.$model->plant_id,$url);
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => Yii::t('app', 'location-delete'),
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',

                            ],
                        ]);
                    }

                ]],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
