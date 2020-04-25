<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Custprojrel */

$this->title = $model->rel_id;
$this->params['breadcrumbs'][] = ['label' => 'Custprojrels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="custprojrel-view">
    <p>
        <?= Html::a('Delete', ['delete?rel_id='.$model->rel_id], [
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
            'project.name',
            'customer.name',
            'date_assigned',
            'deleted',
        ],
    ]) ?>

</div>
