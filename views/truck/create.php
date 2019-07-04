<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Truck */

$this->title = 'Create Truck';
$this->params['breadcrumbs'][] = ['label' => 'Trucks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="truck-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
