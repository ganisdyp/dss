<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use fedemotta\datatables\DataTables;
use app\models\Dieselexpense;
use app\models\Truckexpense;
use app\models\Salerecord;
use app\models\Fuelefficiency;
use app\models\Profile;
use yii\widgets\ActiveForm;
use app\models\Truck;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TruckexpenseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Truck Expense';
$this->params['breadcrumbs'][] = $this->title;



?>
<a target="_blank" href="<?= str_replace('report','reportpdf',$_SERVER['REQUEST_URI']) ?>"><p><i class="fa fa-print"></i> Export as PDF</p></a>
<div class="truckexpense-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php

   /* function getTotalM3ByTruckAndMonth($truck_id,$month){

        $query = Salerecord::find()->select(['SUM(m3) as sum'])->where(['DATE_FORMAT(display_date,"%Y-%m")' => $month, 'deleted' => 0, 'truck_id' => $truck_id])->createCommand()->queryAll();
        $count = 0;
        for ($i = 0; $i < count($query); $i++) {
            $count = $query[$i]["sum"];
        }
        return $count;
    }*/

    $user_role = Yii::$app->user->identity->getRole();
    $user_plant = Profile::findByUserId(Yii::$app->user->identity->getId())->plant->name;
    $user_plant_id = Profile::findByUserId(Yii::$app->user->identity->getId())->plant_id;

 /*   $date_arr = explode("-", $filter_date);
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
    $year_month_str = $year . "-" . $format_month;*/

    //$truckexpenses = $dataProvider->getModels();
    //$dieselexpenses = $dataProvider2->getModels();
   //$fuelefficiency = new Fuelefficiency();
    /*  $checkexisting = Fuelefficiency::findOne(['display_month' => $month.'-01', 'truck_id' => $filter_truck]);

     if(isset($checkexisting)){
         $fe_litre_per_m3 = $checkexisting->litre_per_m3;
         $fe_rm_per_m3 = $checkexisting->rm_per_m3;

     }else {
         $fe_litre_per_m3 = 0;
         $fe_rm_per_m3 = 0;
     }*/



 /*   if($plant_id != 0) {
        $fuelefficiency = Fuelefficiency::findOne(['display_month' => $filter_date, 'truck_id' => $truck_id]);
        if (isset($fuelefficiency)) {
            $fe_litre_per_m3 = $fuelefficiency->litre_per_m3;
            $fe_rm_per_m3 = $fuelefficiency->rm_per_m3;

        }
    }*/
    ?>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <td colspan="1"></td>
            <td colspan="3"><b>MONTH</b>
                <?php
                if (isset($filter_date)) { ?>
                    <?php
                    echo DatePicker::widget([
                        'id' => 'filter_month',
                        'name' => 'filter_month',
                        'value' => date('Y-M'),
                        'options' => ['placeholder' => 'Select month ...',
                            'onchange' => "updateQueryStringParam(\"month\",this.value);"],
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

                } else { ?>
                    <b>DATE/DAY</b> <?php echo strtoupper(date("j / n / Y ( D )")); ?>
                <?php } ?>
            </td>
        </tr>
        </thead>
    </table>
    <table class="table">
        <thead class="thead-dark">
        <tr><td colspan="8"><h4>TRUCK REPORT</h4></td></tr>
        <tr style="background-color: #f3e97a;">
            <th>#</th>
            <th>TRUCK</th>
            <th>VOLUME DELIVERED</th>
            <th>FUEL COST (RM)</th>
            <th>FUEL EFFICIENCY (RM/M3)</th>
        </tr>
        </thead>
        <tbody>
        <?php

        $total_cost_2 = 0.00;
      //  $prosessive_total = 0.00;
        $count_2 = 1;
        foreach ($dieselexpenses as $record) {


            echo '<tr>';
            echo '<td>' . $count_2 . '</td>';
            echo '<td>' . Truck::findOne($record["truck_id"])->truck_no . '</td>';
            echo '<td>'.$record["volume_delivered"].'</td>';
            echo '<td>'.$record["total_cost"].'</td>';
            echo '<td>'.round($record["total_cost"]/$record["volume_delivered"],2).'</td>';
            echo '</tr>';
            $total_cost_2 += $record["total_cost"];

            $count_2++;
        }
        ?>
        <tr style="font-weight:bold;">
            <td colspan="2"></td>
            <td colspan="1" style="text-align:center;">TOTAL COST=</td>
            <td colspan="1"><?= round($total_cost_2,2); ?></td>
            <td colspan="1">RM</td>
        </tr>
        </tbody>
    </table>

    <?php Pjax::end(); ?>

</div>

<?php
$display_button = true;

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


    var urlParamString = location.search.split("truck_id" + "=");
    if (urlParamString.length <= 1){
        
    }
    else {
        var truck_id = urlParamString[1].split("&");
       // if($("#truckexpense-role_hidden").val()==1){
    
        //}else{
            $("#truckexpense-truck_id").val(truck_id);
        //}
    }
    
     var urlParamString2 = location.search.split("month" + "=");
    if (urlParamString2.length <= 1){
        var d = new Date().toISOString().slice(0,10);
        $("#filter_month").val(d);
    } 
    else {
        var date = urlParamString2[1].split("&");
        $("#filter_month").val(date);
    }
/*$('#confirm-form').submit(function(e){
       e.preventDefault(); // dont submit multiple times
       $("#material-ending").submit(function(){
           this.submit();
       $("#cement-intake").submit(function(){
           
       });
     
       });
this.submit();        
});*/
    
  /*  $("#confirm-submit").click(function(){
       $("#material-ending").submit();
       $("#cement-intake").submit();
    });*/
JS;
$this->registerJs($script, \yii\web\View::POS_BEGIN);
$this->registerJs($script2, \yii\web\View::POS_READY);


?>
