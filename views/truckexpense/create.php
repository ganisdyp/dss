<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Truckexpense */

$this->title = 'Create Truckexpense';
$this->params['breadcrumbs'][] = ['label' => 'Truckexpenses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="truckexpense-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
