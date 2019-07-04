<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use fedemotta\datatables\DataTables;
use app\models\Salerecord;
use app\models\SalerecordSearch;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SalerecordSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Salerecords';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="salerecord-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    // ADD WHERE RECORD PLANT = PLANT OF LOGIN USER

    $query = Salerecord::find()->select(['COUNT(*) AS cnt,customer_id,grade_id,project_id'])->where(['display_date'=>date('Y-m-d'),'deleted'=>0])->groupBy(['customer_id','grade_id','project_id'])->createCommand()->queryAll();

    //print_r($query);

    // ADD MORE COLORS
    $color_code = array('#FFC300','#DAF7A6','#FF5733','#C70039','#99CFF7','#DDBCF5','#ffffff');


    for($i=0;$i<count($query);$i++){
        ${'progressive_m3'.$i} = 0;
        $query[$i]["color_code"]=$color_code[$i];
    }

    $salerecords = $dataProvider->getModels();
    ?>

        <table class="table">
            <thead class="thead-dark">
            <tr><td colspan="1"></td><td colspan="6"><b>PLANT:</b> KLANG</td><td colspan="3">DAILY SUMMARY</td><td colspan="2"><b>DATE/DAY</b>  <?php echo strtoupper(date("j / n / Y ( D )"));?></td></tr>
            <tr><td colspan="10"></td><td colspan="2"><b>PRAPARED BY: </b>PLANT ADMIN ( USER )</td></tr>
            <tr>
                <th>#</th><th>Batch No.</th><th>D/O No.</th><th>Customer Name</th><th>Grade</th><th>M3</th><th>Progressive M3</th><th>Truck</th><th>Driver</th><th>Location</th><th>Special Condition</th><th>Remark</th><th></th>
            </tr>
            </thead>
            <tbody>
    <?php
    foreach($salerecords as $record){

        for($i=0;$i<count($query);$i++){

            if($query[$i]["customer_id"]==$record->customer_id && $query[$i]["grade_id"]==$record->grade_id && $query[$i]["project_id"]==$record->project_id){
                ${'progressive_m3'.$i} += $record->m3;
                echo '<tr style="background-color:'.$query[$i]["color_code"].';">';
                echo '<td>'.$record->id.'</td>';
                echo '<td>'.$record->batch_no.'</td>';
                echo '<td>'.$record->delivery_order_no.'</td>';
                echo '<td>'.$record->customer->name.'</td>';
                echo '<td>'.$record->grade->name.'</td>';
                echo '<td>'.(int)$record->m3.'</td>';
                echo '<td>'.${'progressive_m3'.$i}.'</td>';
                echo '<td>'.$record->truck->truck_no.'</td>';
                echo '<td>'.$record->driver->name.'</td>';
                echo '<td>'.$record->project->name.'</td>';
                echo '<td>'.$record->special_condition.'</td>';
                echo '<td>'.$record->remark.'</td>';
                echo '</tr>';
            }else{

            }
        }


    }
    ?>
            </tbody>
        </table>

    <?php Pjax::end(); ?>

</div>
<div class="salerecord-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
