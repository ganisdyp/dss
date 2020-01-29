<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PlantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Plants';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plant-index">

    <p>
        <?= Html::a('Create Plant', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'name',
            'description',
          //  'deleted',
            'plant_prefix',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} ',
                'buttons' => [
                    'view' => function ($url, $model) {
                        $url = str_replace('/'.$model->id,'?id='.$model->id,$url);
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                            'title' => Yii::t('app', 'plant-view'),
                        ]);
                    },
                    'update' => function ($url, $model) {
                        $url = str_replace('/'.$model->id,'?id='.$model->id,$url);
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                            'title' => Yii::t('app', 'plant-update'),
                        ]);
                    },
               /*     'delete' => function ($url, $model) {
                        $url = str_replace('/'.$model->id,'?id='.$model->id,$url);
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => Yii::t('app', 'plant-delete'),
                        ]);
                    }*/

                ],],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
