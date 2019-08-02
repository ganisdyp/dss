<?php
namespace app\controllers;

use app\models\AutoComplete;
use Yii;

class JqueryUiController extends \yii\web\Controller
{
	public function actionAutoComplete()
	{
		$model = new AutoComplete();

		if($model->load(Yii::$app->request->post())){

		}
		return $this->render('auto-complete', [
			'model' => $model
		]);
	}
}