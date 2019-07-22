<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Fuelefficiency */

$this->title = 'Create Fuelefficiency';
$this->params['breadcrumbs'][] = ['label' => 'Fuelefficiencies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fuelefficiency-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
