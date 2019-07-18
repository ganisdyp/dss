<?php

use kartik\date\DatePicker;
use app\models\Salerecord;
use app\models\Profile;
use yii\widgets\ActiveForm;
use app\models\Plant;
use yii\helpers\ArrayHelper;
use miloschuman\highcharts\Highcharts;

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
    } else {
        $query = Salerecord::find()->select(['SUM(m3) as sum'])->where(['DATE_FORMAT(display_date,"%Y-%m")' => $format_date, 'deleted' => 0, 'plant_id' => $plant_id])->createCommand()->queryAll();
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
$year_lastmonth_str = date('Y-M', strtotime('last month'));
$this->title = 'DASHBOARD (' . strtoupper(Plant::findOne($plant_id)->name) . ')';
$days_for_chart = array();

for ($i = 1; $i < ($days_in_month + 1); $i++) {

    /*if ($i == $days_in_month) {
        $days_for_chart .= "'" . $i . "']";
    } else {
        $days_for_chart .= "'" . $i . "',";
    }*/
    $days_for_chart[] = $i;
}


?>
<style>

    table, tr, th, td {
        border: 1px solid #000000 !important;
    }

</style>

<div class="site-index">

    <div class="body-content">

        <div class="row">
            <?php

            if ($user_plant_id == 0) {
                foreach (Plant::find()->where(['<>', 'id', 0])->all() as $plant) { ?>
                    <div class="col-md-4">
                        <table class="table table-responsive">
                            <thead class="thead-dark">
                            <tr>
                                <th colspan="2" bgcolor="#F39C12"><?= strtoupper($plant->name) ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><?= strtoupper(date('j M Y')) ?></td>
                                <td bgcolor="#edce82"><?= getM3ByDateNoFilter(date('Y-m-d'), $plant->id) ?> M3</td>
                            </tr>
                            <tr>
                                <td>THIS MONTH</td>
                                <td bgcolor="#edce82"><?= getTotalM3($year_month_str, $plant->id) ?> M3</td>
                            </tr>
                            <tbody>
                        </table>
                    </div>
                <?php }
            } else {
                ?>
                <div class="col-md-4">
                    <table class="table table-responsive">
                        <thead class="thead-dark">
                        <tr>
                            <th colspan="2" bgcolor="#F39C12"><?= strtoupper($user_plant) ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><?= strtoupper(date('j M Y')) ?></td>
                            <td bgcolor="#edce82"><?= getM3ByDateNoFilter(date('Y-m-d'), $user_plant_id) ?> M3</td>
                        </tr>
                        <tr>
                            <td>THIS MONTH</td>
                            <td bgcolor="#edce82"><?= getTotalM3($year_month_str, $user_plant_id) ?> M3</td>
                        </tr>
                        <tbody>
                    </table>
                </div>
                <?php
            }
            ?>
        </div>
        <div class="row">
            <div class="col-md-5">
                <table class="table table-responsive">
                    <tbody>
                    <tr>
                        <td>TOTAL THIS MONTH</td>
                        <td bgcolor="#edce82"><?= getTotalM3($year_month_str, $user_plant_id) ?> M3</td>
                    </tr>
                    <tr>
                        <td>THIS LAST MONTH</td>
                        <td bgcolor="#edce82"><?= getTotalM3($year_lastmonth_str, $user_plant_id) ?> M3</td>
                    </tr>
                    <tr>
                        <td>TARGET</td>
                        <td bgcolor="#edce82">140 M3</td>
                    </tr>
                    <tbody>
                </table>
            </div>
            <div class="col-md-7">

            </div>
        </div>
        <div class="row">

            <?= Highcharts::widget([
                'options' => [
                    'title' => ['text' => 'Monthly Sales Summary ('.strtoupper($user_plant).')'],
                    'xAxis' => [
                        'categories' => $days_for_chart,

                    ],
                    'yAxis' => [
                        'title' => ['text' => 'Volume'],
                        'plotLines' => [['value'=> 140, 'color'=> 'red', 'width'=> 1,
                            'dashStyle'=> 'longdashdot','label'=>['text'=>'target']]]
                    ],
                    'series' => [
                        ['name' => 'THIS MONTH',
                            'data' => $data,
                        ],
                        ['name' => 'LAST MONTH',
                            'data' => $data2,
                        'color'=>'#ff0000']
                    ],
                    'plotOptions'=> [
                        'line'=> [
                            'dataLabels'=> [
                                'enabled'=> true
                            ],
                        ]
                    ],
                       // $graph
                ]
            ]);
            ?>
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
