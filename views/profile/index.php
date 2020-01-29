<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Profiles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-index">

    <p>
        <?= Html::a('Create Profile', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //  'id',
            'Name',
           // 'date_created',
            'Status',
           // 'user_id',
            //'Username',
            //'Password',
            //'Inactive',
            //'last_accessed',
            //'plant_id',

            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'view' => function ($url, $model) {
                        $url = str_replace('/'.$model->id.'?user_id='.$model->user_id.'&plant_id='.$model->plant_id,'?id='.$model->id.'&user_id='.$model->user_id,$url);
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                            'title' => Yii::t('app', 'profile-view'),
                        ]);
                    },
                    'update' => function ($url, $model) {
                        $url = str_replace('/'.$model->id.'?user_id='.$model->user_id.'&plant_id='.$model->plant_id,'?id='.$model->id.'&user_id='.$model->user_id,$url);
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                            'title' => Yii::t('app', 'profile-update'),
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        $url = str_replace('/'.$model->id.'?user_id='.$model->user_id.'&plant_id='.$model->plant_id,'?id='.$model->id.'&user_id='.$model->user_id,$url);
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => Yii::t('app', 'profile-delete'), 'data-confirm' => Yii::t('app', 'Are you sure you want to delete this user?')
                        ]);
                    }

                ]],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
