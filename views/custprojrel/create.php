<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Custprojrel */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Customer-Project Relationship', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="customer-create">
        <h2>Add Customer</h2>
        <?= $this->render('/customer/_form', [
            'customer' => $customer,
        ]) ?>

    </div>
    <div class="project-create">
        <h2>Add Project</h2>
        <?= $this->render('/project/_form', [
            'project' => $project,
        ]) ?>

    </div>
<div class="custprojrel-create">
    <h2>Create Customer-Project Relationship</h2>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<div class="existing-project" id="existing-project" style="font-size:14pt;">

</div>
<?php
$script = <<< JS

function showProjectList (customer_id) {
   
    $.ajax({
  method: "POST",
  url: "loadproject",
  data: { customer_id: customer_id }
    })
  .done(function( msg ) {
     // alert(msg);
   // var projects = JSON.parse(msg);
    var index = 1;
    document.getElementById("existing-project").innerHTML = "<b>Existing Project</b><br>";
  for(var i in msg){
      document.getElementById("existing-project").innerHTML += ("&#8226 "+msg[i])+"<br>";
  index++;
  }
    //document.getElementById("existing-project").innerHTML = msg;
    
    
   // var projects = msg.split(",");
   // print(projects)
  /*  for(var i in projects){
    document.getElementById("existing-project").innerHTML += '<br>'.projects[i];
    } */
  });
}
JS;

$this->registerJs($script, \yii\web\View::POS_BEGIN);

