<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Custprojrel */

$this->title = 'Create Custprojrel';
$this->params['breadcrumbs'][] = ['label' => 'Custprojrels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="custprojrel-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
