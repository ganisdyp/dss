<?php

use kartik\date\DatePicker;
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

function getM3ByDate($date, $customer, $plant_id)
{
    $timestamp = strtotime($date);
    $format_date = date("Y-m-d", $timestamp);
    /*  $searchModel2 = new SalerecordSearch();
      $salerecord = $searchModel2->search(Yii::$app->request->queryParams);*/

    if ($plant_id == 0) {
        $query = Cashsalerecord::find()->select(['SUM(m3) as sum'])->where(['display_date' => $format_date, 'deleted' => 0, 'customer_id' => $customer])->groupBy('customer_id', 'display_date')->createCommand()->queryAll();
    } else {
        $query = Cashsalerecord::find()->select(['SUM(m3) as sum'])->where(['display_date' => $format_date, 'deleted' => 0, 'customer_id' => $customer, 'plant_id' => $plant_id])->groupBy('customer_id', 'display_date')->createCommand()->queryAll();
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
        $query = Cashsalerecord::find()->select(['SUM(m3) as sum'])->where(['display_date' => $format_date, 'deleted' => 0, 'grade_id' => $grade])->groupBy('grade_id', 'display_date')->createCommand()->queryAll();
    } else {
        $query = Cashsalerecord::find()->select(['SUM(m3) as sum'])->where(['display_date' => $format_date, 'deleted' => 0, 'grade_id' => $grade, 'plant_id' => $plant_id])->groupBy('grade_id', 'display_date')->createCommand()->queryAll();
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
        $query = Cashsalerecord::find()->select(['SUM(m3) as sum'])->where(['DATE_FORMAT(display_date,"%Y-%m")' => $format_date, 'deleted' => 0])->createCommand()->queryAll();
    } else {
        $query = Cashsalerecord::find()->select(['SUM(m3) as sum'])->where(['DATE_FORMAT(display_date,"%Y-%m")' => $format_date, 'deleted' => 0, 'plant_id' => $plant_id])->createCommand()->queryAll();
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
        $query = Cashsalerecord::find()->select(['SUM(m3) as sum'])->where(['DATE_FORMAT(display_date,"%Y-%m")' => $format_date, 'deleted' => 0, 'customer_id' => $customer])->createCommand()->queryAll();
    } else {
        $query = Cashsalerecord::find()->select(['SUM(m3) as sum'])->where(['DATE_FORMAT(display_date,"%Y-%m")' => $format_date, 'deleted' => 0, 'customer_id' => $customer, 'plant_id' => $plant_id])->createCommand()->queryAll();
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
        $query = Cashsalerecord::find()->select(['SUM(m3) as sum'])->where(['DATE_FORMAT(display_date,"%Y-%m")' => $format_date, 'deleted' => 0, 'grade_id' => $grade])->createCommand()->queryAll();
    } else {
        $query = Cashsalerecord::find()->select(['SUM(m3) as sum'])->where(['DATE_FORMAT(display_date,"%Y-%m")' => $format_date, 'deleted' => 0, 'grade_id' => $grade, 'plant_id' => $plant_id])->createCommand()->queryAll();
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
        $query = Cashsalerecord::find()->select(['SUM(m3) as sum'])->where(['display_date' => $format_date, 'deleted' => 0])->groupBy('display_date')->createCommand()->queryAll();
    } else {
        $query = Cashsalerecord::find()->select(['SUM(m3) as sum'])->where(['display_date' => $format_date, 'deleted' => 0, 'plant_id' => $plant_id])->groupBy('display_date')->createCommand()->queryAll();
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

$this->title = 'MONTHLY SALES REPORT (' . strtoupper(Plant::findOne($plant_id)->name) . ' ' . strtoupper($month) . ' ' . strtoupper($year) . ')';

?>
<div class="site-index">
    <div class="body-content">

        <div class="row">
            <table class="table" style="border:none;width:100%;">
                <tr>
                    <td style="border:none;width:25%;"></td>
                    <td style="border:none;width:50%;text-align:center;"><h2>MONTHLY CASH SALE SUMMARY REPORT</h2></td>
                    <td style="border:none;width:25%;"></td>
                </tr>

            </table>
            <table class="table" style="border:none;width:100%;">
                <tr>
                    <td style="border:none;"><h2>PLANT: <?= strtoupper(Plant::findOne(['id'=>$plant_id])->name) ?></h2></td>
                    <td style="border:none;width:35%;"></td>
                    <td style="border:none;"><h2>DATE: <?= date("n / Y",strtotime($filter)); ?></h2></td>
                </tr>

            </table>
            <h4>GROUP BY CUSTOMER</h4>
            <table class="table table-responsive">
                <thead class="thead-dark">
                <tr>
                    <th colspan="1">NO.</th>
                    <th colspan="1">CUSTOMER NAME</th>
                    <th colspan="<?php echo $days_in_month; ?>" style="text-align: center;">DATE</th>
                    <th colspan="1">TOTAL</th>
                    <th colspan="1">%</th>
                </tr>
                <tr>
                    <th colspan="2"></th>
                    <?php
                    for ($date = 1; $date < $days_in_month + 1; $date++) {
                        $date_str = $year . "-" . $format_month . "-" . $date;
                        if (isThisDayAWeekend($date_str)) {
                            ?>
                            <td style="background-color: #b041ff;text-align: center;"><b><?php echo $date; ?></b></td>
                            <?php
                        } else {
                            ?>
                            <td style="text-align: center;"><b><?php echo $date; ?></b></td>
                            <?php
                        }
                    }
                    ?>
                    <th colspan="1" style="background-color: #808080;color:#ffffff;">M3</th>
                    <th colspan="1"></th>
                </tr>
                </thead>
                <tbody>
                <?php

                $index = 1;
                $total_m3 = 0;

                foreach ($customers as $customer) {
                    $total_m3_by_customer = getTotalM3ByCustomer($year_month_str, $customer->id, $plant_id);
                    if($total_m3_by_customer==0){

                    } else {
                        ?>
                        <tr>
                            <td><?php echo $index; ?></td>
                            <td><?php echo $customer->name; ?></td>
                            <?php

                            for ($date = 1; $date < $days_in_month + 1; $date++) {

                                $date_str = $year . "-" . $format_month . "-" . $date;
                                if (isThisDayAWeekend($date_str)) {
                                    ?>
                                    <td style="background-color: #b041ff;text-align: center;"><?php echo getM3ByDate($date_str, $customer->id, $plant_id); ?></td>
                                    <?php
                                } else {
                                    ?>
                                    <td style="text-align: center;"><?php echo getM3ByDate($date_str, $customer->id, $plant_id); ?></td>
                                    <?php
                                }
                            }

                            ?>
                            <td style="background-color: #808080;color:#ffffff;font-weight: 500;"><?php echo $total_m3_by_customer ?></td>
                            <td><?php echo round(($total_m3_by_customer / getTotalM3($year_month_str, $plant_id)) * 100, 2) . '%' ?></td>
                        </tr>

                        <?php
                        $total_m3 += getTotalM3ByCustomer($year_month_str, $customer->id, $plant_id);
                        $index++;
                    }
                }


                ?>
                <tr style="background-color: #808080;color:#ffffff;font-weight: 500;">
                    <td colspan="2"></td>
                    <?php
                    for ($date = 1; $date < $days_in_month + 1; $date++) {
                        $date_str = $year . "-" . $format_month . "-" . $date;
                        if (isThisDayAWeekend($date_str)) {
                            ?>
                            <td style="background-color: #b041ff;text-align: center;"><?php echo getM3ByDateNoFilter($date_str, $plant_id); ?></td>
                            <?php
                        } else {
                            ?>
                            <td style="text-align: center;"><?php echo getM3ByDateNoFilter($date_str, $plant_id); ?></td>
                            <?php
                        }
                    }
                    ?>
                    <td><?php echo getTotalM3($year_month_str, $plant_id) ?></td>
                    <td>100 %</td>
                </tr>

                </tbody>
            </table>
        </div>
        <div class="row">
            <h4>GROUP BY GRADE</h4>
            <table class="table table-responsive">
                <thead class="thead-dark">
                <tr>
                    <th colspan="1">NO.</th>
                    <th colspan="1">GRADE</th>
                    <th colspan="<?php echo $days_in_month; ?>" style="text-align: center;">DATE</th>
                    <th colspan="1">TOTAL</th>
                    <th colspan="1">%</th>
                </tr>
                <tr>
                    <th colspan="2"></th>
                    <?php
                    for ($date = 1; $date < $days_in_month + 1; $date++) {
                        $date_str = $year . "-" . $format_month . "-" . $date;
                        if (isThisDayAWeekend($date_str)) {
                            ?>
                            <td style="background-color: #b041ff;text-align: center;"><b><?php echo $date; ?></b></td>
                            <?php
                        } else {
                            ?>
                            <td style="text-align: center;"><b><?php echo $date; ?></b></td>
                            <?php
                        }
                    }
                    ?>
                    <th colspan="1" style="background-color: #808080;color:#ffffff;">M3</th>
                    <th colspan="1"></th>
                </tr>
                </thead>
                <tbody>
                <?php

                $index = 1;
                $total_m3 = 0;

                foreach ($grades as $grade) {
                    $total_m3_by_grade = getTotalM3ByGrade($year_month_str, $grade->id, $plant_id);
                    if ($total_m3_by_grade == 0) {
                    } else {
                        ?>
                        <tr>
                            <td><?php echo $index; ?></td>
                            <td><?php echo $grade->charac_strength28; ?></td>
                            <?php

                            for ($date = 1; $date < $days_in_month + 1; $date++) {

                                $date_str = $year . "-" . $format_month . "-" . $date;
                                if (isThisDayAWeekend($date_str)) {
                                    ?>
                                    <td style="background-color: #b041ff;text-align: center;"><?php echo getM3ByDateGrade($date_str, $grade->id, $plant_id); ?></td>
                                    <?php
                                } else {
                                    ?>
                                    <td style="text-align: center;"><?php echo getM3ByDateGrade($date_str, $grade->id, $plant_id); ?></td>
                                    <?php
                                }
                            }
                            $total_m3_by_grade = getTotalM3ByGrade($year_month_str, $grade->id, $plant_id);
                            ?>
                            <td style="background-color: #808080;color:#ffffff;font-weight: 500;"><?php echo $total_m3_by_grade ?></td>
                            <td><?php echo round(($total_m3_by_grade / getTotalM3($year_month_str, $plant_id)) * 100, 2) . '%' ?></td>
                        </tr>
                        <?php
                        $total_m3 += getTotalM3ByGrade($year_month_str, $grade->id, $plant_id);
                        $index++;
                    }
                }
                ?>
                <tr style="background-color: #808080;color:#ffffff;font-weight: 500;">
                    <td colspan="2"></td>
                    <?php
                    for ($date = 1; $date < $days_in_month + 1; $date++) {
                        $date_str = $year . "-" . $format_month . "-" . $date;
                        if (isThisDayAWeekend($date_str)) {
                            ?>
                            <td style="background-color: #b041ff;text-align: center;"><?php echo getM3ByDateNoFilter($date_str, $plant_id); ?></td>
                            <?php
                        } else {
                            ?>
                            <td style="text-align: center;"><?php echo getM3ByDateNoFilter($date_str, $plant_id); ?></td>
                            <?php
                        }
                    }
                    ?>
                    <td><?php echo getTotalM3($year_month_str, $plant_id) ?></td>
                    <td>100 %</td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>