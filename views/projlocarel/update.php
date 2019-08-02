<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Projlocarel */

$this->title = 'Update Projlocarel: ' . $model->rel_id;
$this->params['breadcrumbs'][] = ['label' => 'Projlocarels', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->rel_id, 'url' => ['view', 'id' => $model->rel_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="projlocarel-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
