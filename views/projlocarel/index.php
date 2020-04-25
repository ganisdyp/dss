<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Project;
use fedemotta\datatables\DataTables;
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

    <?= DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //  'rel_id',
            'location.name',
            [
                'attribute' => 'project.name',
                'value' => function ($model) {
                    return Project::findOne($model->project_id)->name;
                }
            ],
            'date_assigned',
         //   'deleted',

            ['class' => 'yii\grid\ActionColumn', 'buttons' => [
                'view' => function ($url, $model) {
                    $url = str_replace('/'.$model->rel_id,'?id='.$model->rel_id,$url);
                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                        'title' => Yii::t('app', 'projlocarel-view'),
                    ]);
                },
                'update' => function ($url, $model) {
                    $url = str_replace('/'.$model->rel_id,'?id='.$model->rel_id,$url);
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                        'title' => Yii::t('app', 'projlocarel-update'),
                    ]);
                },
                'delete' => function ($url, $model) {
                    $url = str_replace('/'.$model->rel_id,'?id='.$model->rel_id,$url);
                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                        'title' => Yii::t('app', 'projlocarel-delete'),
                    ]);
                }

            ],],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
