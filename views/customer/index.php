<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-index">



    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'name',
          //  'address',
          //  'phone1',
          //  'phone2',
            //'deleted',
            //'date_created',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} ',
                'buttons' => [
                'view' => function ($url, $model) {
                    $url = str_replace('/'.$model->id,'?id='.$model->id,$url);
                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                        'title' => Yii::t('app', 'customer-view'),
                    ]);
                },
                'update' => function ($url, $model) {
                    $url = str_replace('/'.$model->id,'?id='.$model->id,$url);
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                        'title' => Yii::t('app', 'customer-update'),
                    ]);
                },
             /*   'delete' => function ($url, $model) {
                    $url = str_replace('/'.$model->id,'?id='.$model->id,$url);
                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                        'title' => Yii::t('app', 'customer-delete'),
                    ]);
                }*/

            ],],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
