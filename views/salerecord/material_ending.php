<?php
/**
 * Created by PhpStorm.
 * User: clbs
 * Date: 7/15/2019
 * Time: 11:11 AM
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Materialending;
use app\models\Cementintake;

$materialending = new Materialending();
$cementintake = new Cementintake();

?>
<div class="col-md-3"></div>
<div class="materialending-form col-md-3" id="materialending-form">
    <?php $form = ActiveForm::begin(['id' => 'material-ending']); ?>
    <table class="table table-striped">
        <thead><tr><th colspan="3">DAILY MATERIAL ENDING</th></tr></thead>
        <tbody>
        <tr>
            <td>SILO 1</td>
            <td><?= $form->field($materialending, 'silo1')->textInput(['maxlength' => true])->label(false) ?> </td>
            <td>KG</td>
        </tr>
        <tr>
            <td>SILO 2</td>
            <td><?= $form->field($materialending, 'silo2')->textInput(['maxlength' => true])->label(false) ?></td>
            </td>
            <td>KG</td>
        </tr>
        <tr>
            <td>SILO 3</td>
            <td><?= $form->field($materialending, 'silo3')->textInput(['maxlength' => true])->label(false) ?></td>
            </td>
            <td>KG</td>
        </tr>
        <tr><td colspan="3"></td></tr>
        </tbody>
    </table>

</div>
<div class="col-md-3">

    <table class="table table-striped">
        <thead><tr><th colspan="3">CEMENT INTAKE</th></tr></thead>
        <tbody>
        <tr>
            <td>SILO 1+</td>
            <td><?= $form->field($cementintake, 'silo1')->textInput(['maxlength' => true])->label(false) ?></td>
            <td>KG</td>
        </tr>
        <tr>
            <td>SILO 2+</td>
            <td><?= $form->field($cementintake, 'silo2')->textInput(['maxlength' => true])->label(false) ?></td>
            <td>KG</td>
        </tr>
        <tr>
            <td>SILO 3+</td>
            <td><?= $form->field($cementintake, 'silo3')->textInput(['maxlength' => true])->label(false) ?></td>
            <td>KG</td>
        </tr>
        </tbody>
    </table>
    <?= Html::submitButton('Update', ['class' => 'btn btn-success']) ?>
    <?php ActiveForm::end(); ?>
</div>
<div class="col-md-3"></div>