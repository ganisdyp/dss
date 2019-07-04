<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Salerecord */

$this->title = 'Create Salerecord';
$this->params['breadcrumbs'][] = ['label' => 'Salerecords', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="salerecord-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
