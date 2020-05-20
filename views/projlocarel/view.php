<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Projlocarel */

$this->title = $model->rel_id;
$this->params['breadcrumbs'][] = ['label' => 'Projlocarels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="projlocarel-view">

    <p>
        <?= Html::a('Delete', ['delete', 'id' => $model->rel_id], [
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
            'rel_id',
            'location.name',
            ['label'=>'Project',
                'value' => function($model){
        return $model->project->name;
                }

],
            'date_assigned',
            'deleted',
        ],
    ]) ?>

</div>
