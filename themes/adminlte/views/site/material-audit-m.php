<?php

use kartik\date\DatePicker;
use app\models\Salerecord;
use app\models\Cashsalerecord;
use app\models\Profile;
use yii\widgets\ActiveForm;
use app\models\Plant;
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


function getTotalM3($date, $plant_id)
{
    $timestamp = strtotime($date);
    $format_date = date("Y-m", $timestamp);
    /*  $searchModel2 = new SalerecordSearch();
      $salerecord = $searchModel2->search(Yii::$app->request->queryParams);*/
    if ($plant_id == 0) {
        $query = Salerecord::find()->select(['SUM(m3) as sum'])->where(['DATE_FORMAT(display_date,"%Y-%m")' => $format_date, 'deleted' => 0])->createCommand()->queryAll();
        $query2 = Cashsalerecord::find()->select(['SUM(m3) as sum'])->where(['DATE_FORMAT(display_date,"%Y-%m")' => $format_date, 'deleted' => 0])->createCommand()->queryAll();
    } else {
        $query = Salerecord::find()->select(['SUM(m3) as sum'])->where(['DATE_FORMAT(display_date,"%Y-%m")' => $format_date, 'deleted' => 0, 'plant_id' => $plant_id])->createCommand()->queryAll();
        $query2 = Cashsalerecord::find()->select(['SUM(m3) as sum'])->where(['DATE_FORMAT(display_date,"%Y-%m")' => $format_date, 'deleted' => 0, 'plant_id' => $plant_id])->createCommand()->queryAll();
    }
    $count = 0;
    for ($i = 0; $i < count($query); $i++) {
        if (isset($query2[$i]["sum"])) {
            $count = $query[$i]["sum"] + $query2[$i]["sum"]; // Include Cash sale
        } else {
            $count = $query[$i]["sum"];
        }
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
        $query2 = Cashsalerecord::find()->select(['SUM(m3) as sum'])->where(['display_date' => $format_date, 'deleted' => 0])->groupBy('display_date')->createCommand()->queryAll();
    } else {
        $query = Salerecord::find()->select(['SUM(m3) as sum'])->where(['display_date' => $format_date, 'deleted' => 0, 'plant_id' => $plant_id])->groupBy('display_date')->createCommand()->queryAll();
        $query2 = Cashsalerecord::find()->select(['SUM(m3) as sum'])->where(['display_date' => $format_date, 'deleted' => 0, 'plant_id' => $plant_id])->groupBy('display_date')->createCommand()->queryAll();
    }
    $count = '';
    for ($i = 0; $i < count($query); $i++) {
        if (isset($query2[$i]["sum"])) {
            $count = $query[$i]["sum"] + $query2[$i]["sum"]; // Include Cash sale
        } else {
            $count = $query[$i]["sum"];
        }
    }
    return $count;
}

function getMaterialAuditByDateNoFilter($date, $plant_id)
{
    $timestamp = strtotime($date);
    $format_date = date("Y-m-d", $timestamp);
    if ($plant_id == 0) {
        $material_audit = \app\models\Materialaudit::find()->where(['display_date' => $format_date])->groupBy('display_date')->createCommand()->queryOne();

    } else {
        $material_audit = \app\models\Materialaudit::find()->where(['display_date' => $format_date, 'plant_id' => $plant_id])->groupBy('display_date')->createCommand()->queryOne();

    }
    return $material_audit;
}

function checkIsHoliday($date, $plant_id)
{
    $timestamp = strtotime($date);
    $format_date = date("Y-m-d", $timestamp);
    $is_holiday = \app\models\Materialending::findOne(['display_date' => $format_date, 'is_holiday' => 1, 'plant_id' => $plant_id]);
    return $is_holiday;
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

$this->title = 'MONTHLY MATERIAL AUDIT REPORT (' . strtoupper(Plant::findOne($plant_id)->name) . ' ' . strtoupper($month) . ' ' . strtoupper($year) . ')';

?>
<a target="_blank" href="<?= str_replace('materialauditm','materialauditmpdf',$_SERVER['REQUEST_URI']) ?>"><p><i class="fa fa-print"></i> Export as PDF</p></a>
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
            <? /*= $form->field($model, 'plant')->dropDownList(ArrayHelper::map(Plant::find()->all(), 'id', 'name'),
                ['prompt' => '-Plant-',
                    'onchange' => 'updateQueryStringParam("plant_id",this.value);'])->label(false) */ ?>

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
        ?>
    </div>

    <div class="body-content">
        <div class="row">
          <?php  for ($date = 1; $date < $days_in_month + 1; $date++) {
              if($date==1){
                  $start_date = $date . "-" . $month . "-" . $year;
              }else if($date == $days_in_month){
                  $end_date = $date . "-" . $month . "-" . $year;
              }

          }
            ?>
            <div class="col-md-6">
            <table class="table table-responsive">
                <thead class="thead-dark">
                </thead>
                <tbody>
                <tr>
                    <td>START DATE</td><td><?= $start_date ?></td>
                </tr>
                <tr>
                    <td>END DATE</td><td><?= $end_date ?></td>
                </tr>
                </tbody>

            </table>
            </div>   <div class="col-md-6"></div>
        </div>
        <div class="row">
            <table class="table table-responsive">
                <thead class="thead-dark">
                <tr>
                    <th colspan="1"></th>
                    <th colspan="1">TOTAL MATERIAL NEED</th>
                    <th colspan="1">TOTAL MATERIAL USED</th>
                    <th colspan="1">TOTAL DIFFERENCE (KG)</th>
                    <th colspan="1">TOTAL DIFFERENCE (%)</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach (Plant::find()->where(['<>', 'id', 0])->all() as $plant) {
                    $plant_id = $plant->id;
                    $total_material_need = 0;
                    $total_actual_use = 0;
                    $total_difference_kg = 0.;
                    $total_difference_percent = 0;
                    for ($date = 1; $date < $days_in_month + 1; $date++) {
                        $date_str = $date . "-" . $month . "-" . $year;
                        $material_audit = getMaterialAuditByDateNoFilter($date_str, $plant_id);
                        $is_holiday = checkIsHoliday($date_str, $plant_id);
                        if (isset($is_holiday)) {
                            $background_color = '#ffff00';
                        } else {
                            $background_color = 'transparent';
                        }

                        $material_need = null;
                        if (isset($material_audit["material_need"])) {
                            $material_need = $material_audit["material_need"];
                        }
                        $actual_use = null;
                        if (isset($material_audit["actual_use"])) {
                            $actual_use = $material_audit["actual_use"];
                        }
                        $difference_kg = null;
                        if (isset($material_audit["difference_kg"])) {
                            $difference_kg = $material_audit["difference_kg"];
                        }
                        $difference_percent = null;
                        if (isset($material_audit["difference_percent"])) {
                            $difference_percent = $material_audit["difference_percent"];
                        }
                        ?>

                        <?php
                        $total_material_need += $material_need;
                        $total_actual_use += $actual_use;
                        $total_difference_kg += $difference_kg;
                        $total_difference_percent += $difference_percent;

                    }
                    ?>
                    <tr style="background-color: #808080;color:#ffffff;font-weight: 500;">
                        <td><?= strtoupper(Plant::findOne($plant_id)->name) ?></td>

                        <td><?= round($total_material_need, 2) ?></td>
                        <td><?= round($total_actual_use, 2) ?></td>
                        <td><?= round($total_difference_kg, 2) ?></td>
                        <td><?= round($total_difference_percent, 2) ?></td>
                    </tr>
                <?php } ?>
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
    
JS;
$this->registerJs($script, \yii\web\View::POS_BEGIN);
$this->registerJs($script2, \yii\web\View::POS_READY);
?>
