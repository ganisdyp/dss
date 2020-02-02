<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Projlocarel */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Project-Location Relationship', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="project-create">
        <h2>Add Project</h2>
        <?= $this->render('/project/_form', [
            'project' => $project,
        ]) ?>

    </div>
    <div class="location-create">
        <h2>Add Location</h2>
        <?= $this->render('/location/_form', [
            'location' => $location,
        ]) ?>

    </div>
    <div class="projlocarel-create">
        <h2>Create Project-Location Relationship</h2>
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>
    <div class="existing-location" id="existing-location" style="font-size:14pt;">
<?php
$script = <<< JS

function showLocationList (project_id) {
   
    $.ajax({
  method: "POST",
  url: "loadlocation",
  data: { project_id: project_id }
    })
  .done(function( msg ) {
    //  alert(msg);
   // var projects = JSON.parse(msg);
    var index = 1;
    document.getElementById("existing-location").innerHTML = "<b>Existing Location Related</b><br>";
  for(var i in msg){
      document.getElementById("existing-location").innerHTML += ("&#8226 "+msg[i])+"<br>";
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
