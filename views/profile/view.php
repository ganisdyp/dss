<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Profile */

$this->title = $model->Name;
$this->params['breadcrumbs'][] = ['label' => 'Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="profile-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id, 'UserID' => $model->UserID, 'plant_id' => $model->plant_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id, 'UserID' => $model->UserID, 'plant_id' => $model->plant_id], [
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
            'Name',
            'date_created',
            'Status',
            'UserID',
            'Username',
            'Password',
            'Inactive',
            'last_accessed',
            'plant_id',
        ],
    ]) ?>

</div>
