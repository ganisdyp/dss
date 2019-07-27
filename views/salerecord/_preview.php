<?php

use yii\helpers\Html;
use app\models\Salerecord;
use app\models\Cashsalerecord;
use app\models\Revision;
use app\models\Cementintake;
use app\models\Materialending;
use app\models\Profile;
use yii\widgets\ActiveForm;
use app\models\Plant;
use app\models\Customer;
use app\models\Grade;
use app\models\Project;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SalerecordSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sale records';
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="salerecord-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    $user_role = Yii::$app->user->identity->getRole();
    $user_plant = Profile::findByUserId(Yii::$app->user->identity->getId())->plant->name;
    $user_plant_id = Profile::findByUserId(Yii::$app->user->identity->getId())->plant_id;


    if (isset($filter_plant) && $filter_plant != 0) {
        $plant_id = $filter_plant;
    } else {
        $plant_id = Profile::findByUserId(Yii::$app->user->identity->getId())->plant_id;
    }

    if ($user_role == 1) { // If Plant Admin
        // Limit user from filter by plant_id
        $plant_id = Profile::findByUserId(Yii::$app->user->identity->getId())->plant_id;

    }

    if (isset($filter_date)) {
        $date = $filter_date;
    } else {
        $date = date('Y-m-d');
    }

    // ADD WHERE RECORD PLANT = PLANT OF LOGIN USER

    $query = Salerecord::find()->select(['COUNT(*) AS cnt,customer_id,grade_id,project_id'])->where(['display_date' => $date, 'deleted' => 0, 'plant_id' => $plant_id])->groupBy(['customer_id', 'grade_id', 'project_id'])->createCommand()->queryAll();
    $query2 = Cashsalerecord::find()->select(['COUNT(*) AS cnt,customer_id,grade_id,project_id'])->where(['display_date' => $date, 'deleted' => 0, 'plant_id' => $plant_id])->groupBy(['customer_id', 'grade_id', 'project_id'])->createCommand()->queryAll();

    //print_r($query);

    // ADD MORE COLORS
    $color_code = array('#5D2E8C',
        '#FFFBBD',
        '#CCFF66',
        '#FF6666',
        '#FF8C42',
        '#2EC4B6',
        '#94C9A9',
        '#FFF275',
        '#A89B9D',
        '#CFCFEA',
        '#FCD581',
        '#FFF8E8',
        '#990D35',
        '#8EDCE6',
        '#D5DCF9');


    for ($i = 0; $i < count($query); $i++) {
        ${'progressive_m3' . $i} = 0;
        $query[$i]["color_code"] = $color_code[$i];
    }

    for ($i = 0; $i < count($query2); $i++) {
        ${'progressive_m3_cs' . $i} = 0;
        // $query2[$i]["color_code"] = $color_code[$i]; // same color with salerecord
        $query2[$i]["color_code"] = $color_code[count($query) + $i];
    }

    $salerecords = $dataProvider->getModels();
    $cashsalerecords = $dataProvider2->getModels();

    if (count($salerecords) == 0) { // pending only
        $display_button = true;
    } else {
        $display_button = true;
        foreach ($salerecords as $salerecord) {

            $revision_model = new Revision();
            $existing_revision = Revision::findOne(['batch_no' => $salerecord->batch_no]);

            if ($salerecord->summary_status == 'submitted') {
                $display_button = false;
            }

            /*if(isset($existing_revision)){
                $display_button = true;
            }*/
        }
    }
    $materialending = new Materialending();
    $cementintake = new Cementintake();
    $me_silo1 = 0;
    $me_silo2 = 0;
    $me_silo3 = 0;
    $ci_silo1 = 0;
    $ci_silo2 = 0;
    $ci_silo3 = 0;
    $me_is_holiday = false;
    $ci_is_holiday = false;
    if ($plant_id != 0) {
        $me_record = Materialending::findOne(['display_date' => $date, 'plant_id' => $plant_id]);
        if (isset($me_record)) {
            $me_silo1 = $me_record->silo1;
            $me_silo2 = $me_record->silo2;
            $me_silo3 = $me_record->silo3;
            if ($me_record->is_holiday == 1) {
                $me_is_holiday = true;
            }
        }
        $ci_record = Cementintake::findOne(['display_date' => $date, 'plant_id' => $plant_id]);
        if (isset($ci_record)) {
            $ci_silo1 = $ci_record->silo1;
            $ci_silo2 = $ci_record->silo2;
            $ci_silo3 = $ci_record->silo3;
            if ($ci_record->is_holiday == 1) {
                $ci_is_holiday = true;
            }
        }
    }
    ?>
    <table class="table" style="border:none;width:100%;">
        <tr>
            <td style="border:none;width:25%;"></td>
            <td style="border:none;width:50%;text-align:center;"><h2>DAILY SALE SUMMARY REPORT</h2></td>
            <td style="border:none;width:25%;"></td>
        </tr>

    </table>
    <table class="table" style="border:none;width:100%;">
        <tr>
            <td style="border:none;"><h2>PLANT: <?= strtoupper(Plant::findOne(['id'=>$plant_id])->name) ?></h2></td>
            <td style="border:none;width:35%;"></td>
            <td style="border:none;"><h2>DATE: <?= date("j / n / Y ( D )",strtotime($date)); ?></h2></td>
        </tr>

    </table>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>Batch No.</th>
            <th>D/O No.</th>
            <th>Customer Name</th>
            <th>Grade</th>
            <th>M3</th>
            <th>Progressive M3</th>
            <th>Truck</th>
            <th>Driver</th>
            <th>Location</th>
            <th>Special Condition</th>
            <th>Remark</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $total_m3 = 0;
        $count = 1;
        foreach ($salerecords as $record) {

            for ($i = 0; $i < count($query); $i++) {

                if ($query[$i]["customer_id"] == $record->customer_id && $query[$i]["grade_id"] == $record->grade_id && $query[$i]["project_id"] == $record->project_id) {
                    if ($query[$i]["color_code"] == '#5D2E8C') {
                        $text_color = '#eee';
                    } else {
                        $text_color = '#000000';
                    }
                    ${'progressive_m3' . $i} += $record->m3;
                    echo '<tr style="background-color:' . $query[$i]["color_code"] . ';color:' . $text_color . ';">';
                    echo '<td>' . $count . '</td>';
                    echo '<td>' . $record->batch_no . '</td>';
                    echo '<td>' . $record->delivery_order_no . '</td>';
                    echo '<td>' . $record->customer->name . '</td>';
                    echo '<td>' . $record->grade->charac_strength28 . '</td>';
                    echo '<td>' . round($record->m3, 1) . '</td>';
                    echo '<td>' . ${'progressive_m3' . $i} . '</td>';
                    echo '<td>' . $record->truck->truck_no . '</td>';
                    echo '<td>' . $record->driver->name . '</td>';
                    echo '<td>' . $record->project->name . '</td>';
                    echo '<td>' . $record->special_condition . '</td>';
                    echo '<td>' . $record->remark . '</td>';
                    echo '</tr>';
                    $total_m3 += round($record->m3, 2);
                } else {

                }

            }
            $count++;
        }
        ?>
        <tr style="font-weight:bold;">
            <td colspan="3"></td>
            <td colspan="1" style="text-align:center;">TOTAL</td>
            <td colspan="1"><?= $total_m3; ?></td>
            <td>M3</td>
        </tr>
        </tbody>
    </table>
    <table class="table" style="width:100%;">
        <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>Customer Name</th>
            <th>Grade</th>
            <th>M3</th>
            <th>Location</th>
        </tr>
        </thead>
        <tbody>
        <?php

        $count = 1;

        for ($i = 0; $i < count($query); $i++) {
            // foreach ($salerecords as $record) {

            //   if ($query[$i]["customer_id"] == $record->customer_id && $query[$i]["grade_id"] == $record->grade_id && $query[$i]["project_id"] == $record->project_id) {
            if ($query[$i]["color_code"] == '#5D2E8C') {
                $text_color = '#eee';
            } else {
                $text_color = '#000000';
            }
            echo '<tr style="background-color:' . $query[$i]["color_code"] . ';color:' . $text_color . ';">';
            echo '<td>' . $count . '</td>';
            echo '<td>' . Customer::findOne(["id"=>$query[$i]["customer_id"]])->name . '</td>';
            echo '<td>' . Grade::findOne(["id"=>$query[$i]["grade_id"]])->name . '</td>';
            echo '<td>' . ${'progressive_m3' . $i} . '</td>';
            echo '<td>' . Project::findOne(["id"=>$query[$i]["project_id"]])->name . '</td>';
            echo '</tr>';

            // }
            $count++;
        }
        ?>
        <tr style="font-weight:bold;">
            <td colspan="1"></td>
            <td colspan="1" style="text-align:center;">TOTAL</td>
            <td colspan="1"><?= $total_m3; ?></td>
            <td>M3</td>
        </tr>
        </tbody>
    </table>
    <pagebreak />
            <h3><b>Cash Sale Summary</b></h3>

    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>Batch No.</th>
            <th>D/O No.</th>
            <th>Customer Name</th>
            <th>Grade</th>
            <th>M3</th>
            <th>Progressive M3</th>
            <th>Truck</th>
            <th>Driver</th>
            <th>Location</th>
            <th>Special Condition</th>
            <th>Remark</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $total_m3_cashsale = 0;
        $count_cashsale = 1;
        // print_r($cashsalerecords);
        foreach ($cashsalerecords as $record) {
            for ($i = 0; $i < count($query2); $i++) {
                if ($query2[$i]["customer_id"] == $record->customer_id && $query2[$i]["grade_id"] == $record->grade_id && $query2[$i]["project_id"] == $record->project_id) {
                    $color = $query2[$i]["color_code"];
                }
            }
            for ($i = 0; $i < count($query); $i++) {
                if ($query[$i]["customer_id"] == $record->customer_id && $query[$i]["grade_id"] == $record->grade_id && $query[$i]["project_id"] == $record->project_id) {
                    $color = $query[$i]["color_code"];
                    break;
                }
            }


            for ($i = 0; $i < count($query2); $i++) {

                //  if ($query2[$i]["customer_id"] == $record->customer_id && $query2[$i]["grade_id"] == $record->grade_id && $query2[$i]["project_id"] == $record->project_id) {

                //    $color = $color[$i]["color_code"];

                if ($color == '#5D2E8C') {
                    $text_color = '#eee';
                } else {
                    $text_color = '#000000';
                }
                ${'progressive_m3_cs' . $i} += $record->m3;
                echo '<tr style="background-color:' . $color . ';color:' . $text_color . ';">';
                echo '<td>' . $count_cashsale . '</td>';
                echo '<td>' . $record->batch_no . '</td>';
                echo '<td>' . $record->delivery_order_no . '</td>';
                echo '<td>' . $record->customer->name . '</td>';
                echo '<td>' . $record->grade->charac_strength28 . '</td>';
                echo '<td>' . round($record->m3, 1) . '</td>';
                echo '<td>' . ${'progressive_m3_cs' . $i} . '</td>';
                echo '<td>' . $record->truck->truck_no . '</td>';
                echo '<td>' . $record->driver->name . '</td>';
                echo '<td>' . $record->project->name . '</td>';
                echo '<td>' . $record->special_condition . '</td>';
                echo '<td>' . $record->remark . '</td>';
                echo '</tr>';
                $total_m3_cashsale += round($record->m3, 2);
                /* } else {*/

//                }

            }
            $count_cashsale++;
        }
        ?>
        <tr style="font-weight:bold;">
            <td colspan="3"></td>
            <td colspan="1" style="text-align:center;">TOTAL</td>
            <td colspan="1"><?= $total_m3_cashsale; ?></td>
            <td>M3</td>
        </tr>
        </tbody>
    </table>
    <table class="table" style="width:100%;">
        <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>Customer Name</th>
            <th>Grade</th>
            <th>M3</th>
            <th>Location</th>
        </tr>
        </thead>
        <tbody>
        <?php

        $count_cashsale = 1;

        for ($i = 0; $i < count($query2); $i++) {
            // foreach ($salerecords as $record) {

            //   if ($query[$i]["customer_id"] == $record->customer_id && $query[$i]["grade_id"] == $record->grade_id && $query[$i]["project_id"] == $record->project_id) {
            if ($color == '#5D2E8C') {
                $text_color = '#eee';
            } else {
                $text_color = '#000000';
            }
            echo '<tr style="background-color:' . $color . ';color:' . $text_color . ';">';
            echo '<td>' . $count . '</td>';
            echo '<td>' . Customer::findOne(["id"=>$query2[$i]["customer_id"]])->name . '</td>';
            echo '<td>' . Grade::findOne(["id"=>$query2[$i]["grade_id"]])->name . '</td>';
            echo '<td>' . ${'progressive_m3_cs' . $i} . '</td>';
            echo '<td>' . Project::findOne(["id"=>$query2[$i]["project_id"]])->name . '</td>';
            echo '</tr>';

            // }
            $count_cashsale++;
        }
        ?>
        <tr style="font-weight:bold;">
            <td colspan="1"></td>
            <td colspan="1" style="text-align:center;">TOTAL</td>
            <td colspan="1"><?= $total_m3_cashsale; ?></td>
            <td>M3</td>
        </tr>
        </tbody>
    </table>
</div>

<?php

//if ($user_role != 5) {
    //if ($display_button == true) {


//}


?>
