<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use fedemotta\datatables\DataTables;
use app\models\Salerecord;
use app\models\Profile;
use yii\widgets\ActiveForm;
use app\models\Plant;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

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
    $user_role = Yii::$app->user->identity->getRole();
    $user_plant = Profile::findByUserId(Yii::$app->user->identity->getId())->plant->name;
    $user_plant_id = Profile::findByUserId(Yii::$app->user->identity->getId())->plant_id;


    if(isset($filter_plant) && $filter_plant != 0){
        $plant_id = $filter_plant;
    }else{
        $plant_id = Profile::findByUserId(Yii::$app->user->identity->getId())->plant_id;
    }

    if($user_role == 1){ // If Plant Admin
        // Limit user from filter by plant_id
        $plant_id = Profile::findByUserId(Yii::$app->user->identity->getId())->plant_id;

    }

    if(isset($filter_date)){
        $date = $filter_date;
    }else{
        $date = date('Y-m-d');
    }

    // ADD WHERE RECORD PLANT = PLANT OF LOGIN USER

    $query = Salerecord::find()->select(['COUNT(*) AS cnt,customer_id,grade_id,project_id'])->where(['display_date' => $date, 'deleted' => 0, 'plant_id' => $plant_id])->groupBy(['customer_id', 'grade_id', 'project_id'])->createCommand()->queryAll();

    //print_r($query);

    // ADD MORE COLORS
    $color_code = array('#FFC300', '#DAF7A6', '#FF5733', '#C70039', '#99CFF7', '#DDBCF5', '#ffffff');


    for ($i = 0; $i < count($query); $i++) {
        ${'progressive_m3' . $i} = 0;
        $query[$i]["color_code"] = $color_code[$i];
    }

    $salerecords = $dataProvider->getModels();

    ?>

    <table class="table">
        <thead class="thead-dark">
        <tr>
            <td colspan="1"></td>
            <td colspan="2"><b>PLANT:</b><?php
                if ($user_role != 1) { ?>
                    <?php $form = ActiveForm::begin(); ?>
             <?= $form->field($model, 'plant')->dropDownList(ArrayHelper::map(Plant::find()->where(['<>','id',0])->all(), 'id', 'name'),
                ['prompt' => '-Plant-',
                    'onchange' =>'updateQueryStringParam("plant_id",this.value);'])->label(false) ?>
                    <?= $form->field($model, 'role_hidden')->hiddenInput(
                        ['value'=>$user_role
                        ])->label(false) ?>
             <?php ActiveForm::end();
                } else {
                    $form = ActiveForm::begin(); ?>
             <?= $form->field($model, 'plant')->dropDownList(ArrayHelper::map(Plant::find()->where(['id'=>$user_plant_id])->all(), 'id', 'name'),
                        ['options'=>[$user_plant_id=>['Selected'=>true]]
                            ,'disabled'=>true])->label(false) ?>
                    <?= $form->field($model, 'role_hidden')->hiddenInput(
                        ['value'=>$user_role
                        ])->label(false) ?>

             <?php ActiveForm::end();
                } ?>
            </td>
            <td colspan="2"></td>
            <td colspan="4">DAILY SUMMARY</td>
            <td colspan="3">DATE:
                <?php
                if ($filter_date != $date || isset($filter_date)) { ?>
                    <?php $form = ActiveForm::begin(); ?>
                    <?= $form->field($model, 'display_date')->widget(DatePicker::class, [
                        'options' => ['placeholder' => 'Enter sale date ...',
                            'onchange'=> "updateQueryStringParam(\"date\",this.value);"],
                        'removeButton' => false,
                        'pluginOptions' => [
                            'todayHighlight' => true,
                            'autoclose'=>true,
                            'format' => 'yyyy-mm-dd',
                        ]
                    ])->label(false); ?>
                    <?php ActiveForm::end();
                } else { ?>
                <b>DATE/DAY</b> <?php echo strtoupper(date("j / n / Y ( D )")); ?>
               <?php } ?>
            </td>
        </tr>
        <tr>
            <td colspan="10"></td>
            <td colspan="2"><b>PRAPARED BY: </b>PLANT ADMIN ( USER )</td>
        </tr>
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
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $total_m3 = 0;
        foreach ($salerecords as $record) {

            for ($i = 0; $i < count($query); $i++) {

                if ($query[$i]["customer_id"] == $record->customer_id && $query[$i]["grade_id"] == $record->grade_id && $query[$i]["project_id"] == $record->project_id) {
                    ${'progressive_m3' . $i} += $record->m3;
                    echo '<tr style="background-color:' . $query[$i]["color_code"] . ';">';
                    echo '<td>' . $record->id . '</td>';
                    echo '<td>' . $record->batch_no . '</td>';
                    echo '<td>' . $record->delivery_order_no . '</td>';
                    echo '<td>' . $record->customer->name . '</td>';
                    echo '<td>' . $record->grade->charac_strength28 . '</td>';
                    echo '<td>' . (int)$record->m3 . '</td>';
                    echo '<td>' . ${'progressive_m3' . $i} . '</td>';
                    echo '<td>' . $record->truck->truck_no . '</td>';
                    echo '<td>' . $record->driver->name . '</td>';
                    echo '<td>' . $record->project->name . '</td>';
                    echo '<td>' . $record->special_condition . '</td>';
                    echo '<td>' . $record->remark . '</td>';
                    echo '</tr>';
                    $total_m3 += (int)$record->m3;
                } else {

                }
            }


        }
        ?>
        <tr style="font-weight:bold;"><td colspan="3"></td><td colspan="1" style="text-align:center;">TOTAL</td><td colspan="1"><?= $total_m3; ?></td><td>M3</td></tr>
        </tbody>
    </table>

    <?php Pjax::end(); ?>

</div>
<?php if ($user_role != 5) { ?>
    <div class="salerecord-create">

        <?= $this->render('create', [
            'model' => $model,
        ]) ?>

    </div>

<?php }
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
        
    }
    else {
        var plant_id = urlParamString[1].split("&");
        if($("#salerecord-role_hidden").val()==1){
    
        }else{
            $("#salerecord-plant").val(plant_id);
        }
    }
    
     var urlParamString2 = location.search.split("date" + "=");
    if (urlParamString2.length <= 1){
        var d = new Date().toISOString().slice(0,10);
        $("#salerecord-display_date").val(d);
    } 
    else {
        var date = urlParamString2[1].split("&");
        $("#salerecord-display_date").val(date);
    }

JS;
$this->registerJs($script,\yii\web\View::POS_BEGIN);
$this->registerJs($script2,\yii\web\View::POS_READY);


?>
