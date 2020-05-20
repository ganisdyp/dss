<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use fedemotta\datatables\DataTables;
/* @var $this yii\web\View */
/* @var $searchModel app\models\GradeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Grades';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grade-index">

    <p>
        <?= Html::a('Create Grade', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php if(Yii::$app->user->identity->getRole() == 1){ ?>
        <?= DataTables::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //  'id',
                'name',
                'charac_strength28',
                'cement_type',
                'specified_slump',


                ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update} {delete}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            $url = str_replace('/' . $model->id, '?id=' . $model->id, $url);
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                'title' => Yii::t('app', 'grade-view'),
                            ]);
                        },
                        'update' => function ($url, $model) {
                            $url = str_replace('/' . $model->id, '?id=' . $model->id, $url);
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                'title' => Yii::t('app', 'grade-update'),
                            ]);
                        },
                        'delete' => function ($url, $model) {
                            $url = str_replace('/' . $model->id, '?id=' . $model->id, $url);
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                'title' => Yii::t('app', 'grade-delete'),
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'post',

                                ],
                            ]);
                        }

                    ],
                ],
            ],

        ]); ?>
 <?php   }else { ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //  'id',
                'name',
                'charac_strength28',
                'cement_type',
                'specified_slump',
                //'coarse_agg_type',
                //'fine_agg_type',
                //'admixture',

                'mix_design_for_cal',
                //'deleted',

                ['class' => 'yii\grid\ActionColumn',  'template' => '{view} {update} {delete}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            $url = str_replace('/'.$model->id,'?id='.$model->id,$url);
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                'title' => Yii::t('app', 'grade-view'),
                            ]);
                        },
                        'update' => function ($url, $model) {
                            $url = str_replace('/'.$model->id,'?id='.$model->id,$url);
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                'title' => Yii::t('app', 'grade-update'),
                            ]);
                        },
                        'delete' => function ($url, $model) {
                            $url = str_replace('/'.$model->id,'?id='.$model->id,$url);
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                'title' => Yii::t('app', 'grade-delete'),
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'post',

                                ],
                            ]);
                        }

                    ],
                ],
            ],

        ]); ?>
    <?php }
    ?>


    <?php Pjax::end(); ?>

</div>
