<?php

use kartik\date\DatePicker;
use app\models\Salerecord;
use app\models\Profile;
use yii\widgets\ActiveForm;
use app\models\Plant;
use app\models\Driver;
use app\models\Location;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */

Yii::$app->db->open();

function isThisDayAWeekend($date)
{
    $timestamp = strtotime($date);

    $weekday = date("l", $timestamp);

    if ($weekday == "Sunday") {
        return true;
    } else {
        return false;
    }
}

function getM3ByDate($date, $customer, $plant_id)
{
    $timestamp = strtotime($date);
    $format_date = date("Y-m-d", $timestamp);
    /*  $searchModel2 = new SalerecordSearch();
      $salerecord = $searchModel2->search(Yii::$app->request->queryParams);*/

    if ($plant_id == 0) {
        $query = Salerecord::find()->select(['SUM(m3) as sum'])->where(['display_date' => $format_date, 'deleted' => 0, 'customer_id' => $customer])->groupBy('customer_id', 'display_date')->createCommand()->queryAll();
    } else {
        $query = Salerecord::find()->select(['SUM(m3) as sum'])->where(['display_date' => $format_date, 'deleted' => 0, 'customer_id' => $customer, 'plant_id' => $plant_id])->groupBy('customer_id', 'display_date')->createCommand()->queryAll();
    }
    $count = '';
    for ($i = 0; $i < count($query); $i++) {
        $count = $query[$i]["sum"];
    }
    return $count;

}

function getM3ByDateGrade($date, $grade, $plant_id)
{
    $timestamp = strtotime($date);
    $format_date = date("Y-m-d", $timestamp);
    /*  $searchModel2 = new SalerecordSearch();
      $salerecord = $searchModel2->search(Yii::$app->request->queryParams);*/

    if ($plant_id == 0) {
        $query = Salerecord::find()->select(['SUM(m3) as sum'])->where(['display_date' => $format_date, 'deleted' => 0, 'customer_id' => $grade])->groupBy('grade_id', 'display_date')->createCommand()->queryAll();
    } else {
        $query = Salerecord::find()->select(['SUM(m3) as sum'])->where(['display_date' => $format_date, 'deleted' => 0, 'customer_id' => $grade, 'plant_id' => $plant_id])->groupBy('grade_id', 'display_date')->createCommand()->queryAll();
    }
    $count = '';
    for ($i = 0; $i < count($query); $i++) {
        $count = $query[$i]["sum"];
    }
    return $count;

}

function getTotalM3($date, $plant_id)
{
    $timestamp = strtotime($date);
    $format_date = date("Y-m", $timestamp);
    /*  $searchModel2 = new SalerecordSearch();
      $salerecord = $searchModel2->search(Yii::$app->request->queryParams);*/
    if ($plant_id == 0) {
        $query = Salerecord::find()->select(['SUM(m3) as sum'])->where(['DATE_FORMAT(display_date,"%Y-%m")' => $format_date, 'deleted' => 0])->createCommand()->queryAll();
    } else {
        $query = Salerecord::find()->select(['SUM(m3) as sum'])->where(['DATE_FORMAT(display_date,"%Y-%m")' => $format_date, 'deleted' => 0, 'plant_id' => $plant_id])->createCommand()->queryAll();
    }

    $count = 0;
    for ($i = 0; $i < count($query); $i++) {
        $count = $query[$i]["sum"];
    }
    return $count;


}

function getTotalM3ByCustomer($date, $customer, $plant_id)
{
    $timestamp = strtotime($date);
    $format_date = date("Y-m", $timestamp);
    /*  $searchModel2 = new SalerecordSearch();
      $salerecord = $searchModel2->search(Yii::$app->request->queryParams);*/
    if ($plant_id == 0) {
        $query = Salerecord::find()->select(['SUM(m3) as sum'])->where(['DATE_FORMAT(display_date,"%Y-%m")' => $format_date, 'deleted' => 0, 'customer_id' => $customer])->createCommand()->queryAll();
    } else {
        $query = Salerecord::find()->select(['SUM(m3) as sum'])->where(['DATE_FORMAT(display_date,"%Y-%m")' => $format_date, 'deleted' => 0, 'customer_id' => $customer, 'plant_id' => $plant_id])->createCommand()->queryAll();
    }
    $count = 0;
    for ($i = 0; $i < count($query); $i++) {
        $count = $query[$i]["sum"];
    }
    return $count;


}

function getTotalM3ByGrade($date, $grade, $plant_id)
{
    $timestamp = strtotime($date);
    $format_date = date("Y-m", $timestamp);
    /*  $searchModel2 = new SalerecordSearch();
      $salerecord = $searchModel2->search(Yii::$app->request->queryParams);*/
    if ($plant_id == 0) {
        $query = Salerecord::find()->select(['SUM(m3) as sum'])->where(['DATE_FORMAT(display_date,"%Y-%m")' => $format_date, 'deleted' => 0, 'grade_id' => $grade])->createCommand()->queryAll();
    } else {
        $query = Salerecord::find()->select(['SUM(m3) as sum'])->where(['DATE_FORMAT(display_date,"%Y-%m")' => $format_date, 'deleted' => 0, 'grade_id' => $grade, 'plant_id' => $plant_id])->createCommand()->queryAll();
    }
    $count = 0;
    for ($i = 0; $i < count($query); $i++) {
        $count = $query[$i]["sum"];
    }
    return $count;


}

function getM3ByDateNoFilter($date, $plant_id)
{
    $timestamp = strtotime($date);
    $format_date = date("Y-m-d", $timestamp);
    /*  $searchModel2 = new SalerecordSearch();
      $salerecord = $searchModel2->search(Yii::$app->request->queryParams);*/
    if ($plant_id == 0) {
        $query = Salerecord::find()->select(['SUM(m3) as sum'])->where(['display_date' => $format_date, 'deleted' => 0])->groupBy('display_date')->createCommand()->queryAll();
    } else {
        $query = Salerecord::find()->select(['SUM(m3) as sum'])->where(['display_date' => $format_date, 'deleted' => 0, 'plant_id' => $plant_id])->groupBy('display_date')->createCommand()->queryAll();
    }
    $count = '';
    for ($i = 0; $i < count($query); $i++) {
        $count = $query[$i]["sum"];
    }
    return $count;

}

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

$date_arr = explode("-", $filter);
$year = $date_arr[0];
$month = $date_arr[1];
if ($month == 'Jan') {
    $format_month = 1;
} else if ($month == 'Feb') {
    $format_month = 2;
} else if ($month == 'Mar') {
    $format_month = 3;
} else if ($month == 'Apr') {
    $format_month = 4;
} else if ($month == 'May') {
    $format_month = 5;
} else if ($month == 'Jun') {
    $format_month = 6;
} else if ($month == 'Jul') {
    $format_month = 7;
} else if ($month == 'Aug') {
    $format_month = 8;
} else if ($month == 'Sep') {
    $format_month = 9;
} else if ($month == 'Oct') {
    $format_month = 10;
} else if ($month == 'Nov') {
    $format_month = 11;
} else if ($month == 'Dec') {
    $format_month = 12;
}

$days_in_month = cal_days_in_month(CAL_GREGORIAN, $format_month, $year);
$year_month_str = $year . "-" . $format_month;

$this->title = 'DRIVER TRIP REPORT (' . strtoupper(Plant::findOne($plant_id)->name) . ' ' . strtoupper($month) . ' ' . strtoupper($year) . ')';

?>
<style>

    table, tr, th, td {
        border: 1px solid #000000 !important;
    }

</style>
<div class="site-index">

    <div class="jumbotron">
        <?php
        if ($user_role != 1) { ?>
            <?php
            $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'plant')->dropDownList(ArrayHelper::map(Plant::find()->all(), 'id', 'name'),
                ['prompt' => '-Plant-',
                    'onchange' => 'updateQueryStringParam("plant_id",this.value);'])->label(false) ?>

            <?php ActiveForm::end();
        } else {
            $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'plant')->dropDownList(ArrayHelper::map(Plant::find()->where(['id' => $user_plant_id])->all(), 'id', 'name'),
                ['options' => [$user_plant_id => ['Selected' => true]]
                    , 'disabled' => true])->label(false) ?>
            <?= $form->field($model, 'role_hidden')->hiddenInput(
                ['value' => $user_role
                ])->label(false) ?>

            <?php ActiveForm::end();
        }
        echo DatePicker::widget([

            'name' => 'filter_month',
            'value' => date('Y-M'),
            'options' => ['placeholder' => 'Select month ...',
                'onchange' => "updateQueryStringParam(\"filter\",this.value);"],
            'removeButton' => false,
            'pluginOptions' => [
                'autoclose' => true,
                'startView' => 'year',
                'minViewMode' => 'months',
                'format' => 'yyyy-M',
                'todayHighlight' => true,
                'endDate' => "0d"
            ]
        ]);
echo '<br>';
        $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'driver')->dropDownList(ArrayHelper::map(Driver::find()->all(), 'id', 'name'),
            ['prompt' => '-Driver-',
                'onchange' => 'updateQueryStringParam("driver_id",this.value);'])->label(false) ?>

        <?php ActiveForm::end(); ?>
    </div>

    <div class="body-content">

        <div class="row">
            <h4>DRIVER: <?= Driver::findOne($filter_driver)->name; ?></h4>
            <table class="table table-responsive">
                <thead class="thead-dark">
                <tr style="background-color: #808080;color:#ffffff;font-weight: 500;">
                    <th colspan="1">DATE</th>
                    <th colspan="1">BATCH NO</th>
                    <th colspan="1" style="text-align: center;">D/O NUMBER</th>
                    <th colspan="1">GRADE</th>
                    <th colspan="1">M3</th>
                    <th colspan="1">TRUCK</th>
                    <th colspan="1">CUSTOMER NAME</th>
                    <th colspan="1">PROJECT</th>
                    <th colspan="1">LOCATION</th>
                    <th colspan="1">SPECIAL CONDITION*</th>
                    <th colspan="1">RATE/TRIP</th>
                </tr>
                </thead>
                <tbody>
                <?php

                $index = 1;
                $total_rm_display = 0;
                //print_r($drivertrips);
                foreach ($drivertrips as $drivertrip) {

                    ?>
                    <tr>
                        <td><?= date("j-M-Y",strtotime($drivertrip->display_date)); ?></td>
                        <td><?= $drivertrip->plant->plant_prefix.' '.$drivertrip->batch_no; ?></td>
                        <td><?= $drivertrip->plant->plant_prefix.' '.$drivertrip->delivery_order_no; ?></td>
                        <td><?= $drivertrip->grade->name; ?></td>
                        <td><?= $drivertrip->m3; ?></td>
                        <td><?= $drivertrip->truck->truck_no; ?></td>
                        <td><?= $drivertrip->customer->name; ?></td>
                        <td><?= $drivertrip->project->name; ?></td>
                        <td><?= Location::findOne($drivertrip->project->location_id)->name; ?></td>
                        <td><?= $drivertrip->special_condition; ?></td>
                        <td>
                            <?php
                            $total_rm = round(Location::findOne($drivertrip->project->location_id)->rate_number);
                            if($drivertrip->special_condition == 'double trip'){
                                $total_rm*=2;
                            }else if($drivertrip->special_condition == 'trial mix' || $drivertrip->special_condition == 'rejected' || $drivertrip->special_condition == 'cancelled'){
                                $total_rm=0;
                            }
                            echo Location::findOne($drivertrip->project->location_id)->rate_prefix.$total_rm;
                            $total_rm_display += $total_rm;
                            ?>
                        </td>
                    </tr>
                    <?php
                   // $total_m3 += getTotalM3ByCustomer($year_month_str, $customer->id, $plant_id);
                    $index++;
                }


                ?>
                <tr>
                    <td colspan="9"></td>
                    <td style="background-color: #808080;color:#ffffff;font-weight: 500;">TOTAL</td>
                    <td style="background-color: #808080;color:#ffffff;font-weight: 500;">RM<?= $total_rm_display ?></td>
                </tr>

                </tbody>
            </table>
        </div>

    </div>
</div>
<?php
$script = <<< JS

 function updateQueryStringParam (key, value) {

    var baseUrl = [location.protocol, '//', location.host, location.pathname].join(''),
        urlQueryString = document.location.search,
        newParam = key + '=' + value,
        params = '?' + newParam;

    // If the "search" string exists, then build params from it
    if (urlQueryString) {
        var updateRegex = new RegExp('([\?&])' + key + '[^&]*');
        var removeRegex = new RegExp('([\?&])' + key + '=[^&;]+[&;]?');

        if( typeof value == 'undefined' || value == null || value == '' ) { // Remove param if value is empty
            params = urlQueryString.replace(removeRegex, "$1");
            params = params.replace( /[&;]$/, "" );

        } else if (urlQueryString.match(updateRegex) !== null) { // If param exists already, update it
            params = urlQueryString.replace(updateRegex, "$1" + newParam);

        } else { // Otherwise, add it to end of query string
            params = urlQueryString + '&' + newParam;
        }
    }

    // no parameter was set so we don't need the question mark
    params = params == '?' ? '' : params;

    return document.location=baseUrl + params;
}

JS;
$script2 = <<< JS

    var urlParamString = location.search.split("plant_id" + "=");
    if (urlParamString.length <= 1){
        
    } else {
        var plant_id = urlParamString[1].split("&");
        if($("#salerecord-role_hidden").val()==1){
    
        }else{
            $("#salerecord-plant").val(plant_id);
        }
    }

    var urlParamString2 = location.search.split("filter" + "=");
    if (urlParamString2.length <= 1){
       // var filter_month = urlParamString[1].split("&");
         
          //  $("#filter_month").val(filter_month); 
    } else {
      // alert(urlParamString[1]);
       $("input[name='filter_month']").val(urlParamString2[1]);
    }
    
     var urlParamString3 = location.search.split("driver_id" + "=");
    if (urlParamString3.length <= 1){
        
    } else {
        var driver_id = urlParamString3[1].split("&");
        if($("#salerecord-role_hidden").val()==1){
    
        }else{
            $("#salerecord-driver").val(driver_id);
        }
    }
JS;
$this->registerJs($script, \yii\web\View::POS_BEGIN);
$this->registerJs($script2, \yii\web\View::POS_READY);
?>
