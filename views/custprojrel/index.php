<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use fedemotta\datatables\DataTables;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CustprojrelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customer-Project Relationship';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="custprojrel-index">

    <p>
        <?= Html::a('Create Customer-Project Relationship', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //  'rel_id',
            'date_assigned',
          //  'deleted',
            'customer.name',
            'project.name',
            ['class' => 'yii\grid\ActionColumn', 'buttons' => [
                'view' => function ($url, $model) {
                    $url = str_replace('/'.$model->rel_id,'?id='.$model->rel_id,$url);
                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                        'title' => Yii::t('app', 'custprojrel-view'),
                    ]);
                },
                'update' => function ($url, $model) {
                    $url = str_replace('/'.$model->rel_id,'?id='.$model->rel_id,$url);
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                        'title' => Yii::t('app', 'custprojrel-update'),
                    ]);
                },
                'delete' => function ($url, $model) {
                    $url = str_replace('/'.$model->rel_id,'?id='.$model->rel_id,$url);
                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                        'title' => Yii::t('app', 'custprojrel-delete'),
                    ]);
                }

            ],],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
