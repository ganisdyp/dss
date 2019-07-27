<?php

use kartik\date\DatePicker;
use app\models\Salerecord;
use app\models\Profile;
use yii\widgets\ActiveForm;
use app\models\Plant;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\JsExpression;
use edofre\fullcalendar\models\Event;

/* @var $this yii\web\View */

Yii::$app->db->open();

$user_role = Yii::$app->user->identity->getRole();
$user_plant = Profile::findByUserId(Yii::$app->user->identity->getId())->plant->name;
$user_plant_id = Profile::findByUserId(Yii::$app->user->identity->getId())->plant_id;

$this->title = 'WELCOME TO DSS SYSTEM';
if($user_role!=1){
    if(isset($_GET["plant_id"])) {
        $plant_id = $_GET["plant_id"];
    }else{
        $plant_id = 0;
    }
}else{
    $plant_id = $user_plant_id;
}
?>

    <style>

        /*table, tr, th, td {
            border: 1px solid #000000 !important;
        }*/

    </style>
    <div class="site-index">
        <div class="body-content">
<div class="row">
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <td colspan="1"></td>
            <td colspan="2"><b>PLANT:</b><?php
                if ($user_role != 1) { ?>
                    <?php $form = ActiveForm::begin(); ?>
                    <?= $form->field($model, 'plant')->dropDownList(ArrayHelper::map(Plant::find()->where(['<>', 'id', 0])->all(), 'id', 'name'),
                        ['prompt' => '-Plant-',
                            'onchange' => 'updateQueryStringParam("plant_id",this.value);'])->label(false) ?>
                    <?= $form->field($model, 'role_hidden')->hiddenInput(
                        ['value' => $user_role
                        ])->label(false) ?>
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
                } ?>
            </td>
            <td colspan="2"></td>

        </tr>
        </thead>
    </table>
</div>
            <div class="row" id="my-calendar">

                <?= edofre\fullcalendar\Fullcalendar::widget([
                    'header' => [
                        'left' => 'prev,next today',
                        'center' => 'title',
                        'right' => 'month'
                    ],
                    'clientOptions' => [
                        'lang' => 'en',
                        'lazyFetching' => true,
                        'timeFormat' => 'H:mm',
                        'forceEventDuration' => true,
                        'ignoreTimezone' => true,
                        'displayEventTime' => false,
                        'eventRender' => new JsExpression('
                function(event,element) {
                    console.log(event.title);
                    console.log(event.url);
                    if (event.title) {
         element.find("span.fc-title").html("<center><a href=\'"+(event.url)+"\'><img src=\'"+(event.title)+"\' width=\'50\' height=\'50\'></a></center>"); 
    }
                }
            '),
                        //... more options to be defined here!
                    ],
                    // 'events'        => $events
                    'events' => Url::to(['events?plant_id=' . $plant_id]),
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
        
    }
    else {
        var plant_id = urlParamString[1].split("&");
        if($("#salerecord-role_hidden").val()==1){
    
        }else{
            $("#salerecord-plant").val(plant_id);
        }
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


