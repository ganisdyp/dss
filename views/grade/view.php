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
    <?php if(Yii::$app->user->identity->getRole() == 1){ ?>
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
        ],
    ]) ?>
    <?php } else{ ?>
        // display error message
        <?php if (Yii::$app->session->hasFlash('error')): ?>
            <div class="alert alert-danger alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <h4><i class="icon fa fa-check"></i>Saved!</h4>
                <?= Yii::$app->session->getFlash('warning') ?>
            </div>
        <?php endif; ?>
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
            ],
        ]) ?>
    <?php } ?>
</div>
