<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Grade */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Grades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="grade-view">

    <p>
        <?= Html::a('Update', ['update?id='.$model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete?id='.$model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'charac_strength28',
            'cement_type',
            'specified_slump',
            'coarse_agg_type',
            'fine_agg_type',
            'admixture',
            'mix_design_for_cal',
            'deleted',
        ],
    ]) ?>

</div>
