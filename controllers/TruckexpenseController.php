<?php

namespace app\controllers;

use Yii;
use app\models\Truckexpense;
use app\models\TruckexpenseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TruckexpenseController implements the CRUD actions for Truckexpense model.
 */
class TruckexpenseController extends Controller
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
     * Lists all Truckexpense models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TruckexpenseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Truckexpense model.
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
     * Creates a new Truckexpense model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Truckexpense();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'truck_id' => $model->truck_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Truckexpense model.
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
     * Deletes an existing Truckexpense model.
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
     * Finds the Truckexpense model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $truck_id
     * @return Truckexpense the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $truck_id)
    {
        if (($model = Truckexpense::findOne(['id' => $id, 'truck_id' => $truck_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
