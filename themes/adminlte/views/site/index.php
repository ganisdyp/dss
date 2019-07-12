<?php

use kartik\date\DatePicker;
use app\models\Salerecord;
use app\models\Profile;
use yii\widgets\ActiveForm;
use app\models\Plant;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */

Yii::$app->db->open();

$user_role = Yii::$app->user->identity->getRole();
$user_plant = Profile::findByUserId(Yii::$app->user->identity->getId())->plant->name;
$user_plant_id = Profile::findByUserId(Yii::$app->user->identity->getId())->plant_id;

$this->title = 'WELCOME TO DSS SYSTEM';

?>
<style>

    table, tr, th, td {
        border: 1px solid #000000 !important;
    }

</style>
<div class="site-index">

    <div class="jumbotron">

    </div>

    <div class="body-content">

        <div class="row">

        </div>
    </div>
</div>