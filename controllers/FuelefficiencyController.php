<?php

namespace app\controllers;

use Yii;
use app\models\Fuelefficiency;
use app\models\FuelefficiencySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FuelefficiencyController implements the CRUD actions for Fuelefficiency model.
 */
class FuelefficiencyController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Fuelefficiency models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FuelefficiencySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Fuelefficiency model.
     * @param integer $id
     * @param integer $truck_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $truck_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $truck_id),
        ]);
    }

    /**
     * Creates a new Fuelefficiency model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Fuelefficiency();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'truck_id' => $model->truck_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Fuelefficiency model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $truck_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $truck_id)
    {
        $model = $this->findModel($id, $truck_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'truck_id' => $model->truck_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Fuelefficiency model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $truck_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $truck_id)
    {
        $this->findModel($id, $truck_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Fuelefficiency model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $truck_id
     * @return Fuelefficiency the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $truck_id)
    {
        if (($model = Fuelefficiency::findOne(['id' => $id, 'truck_id' => $truck_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
