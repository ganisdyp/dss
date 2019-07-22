<?php

namespace app\controllers;

use Yii;
use app\models\Cashsalerecord;
use app\models\CashsalerecordSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CashsalerecordController implements the CRUD actions for Cashsalerecord model.
 */
class CashsalerecordController extends Controller
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
     * Lists all Cashsalerecord models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CashsalerecordSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cashsalerecord model.
     * @param integer $id
     * @param integer $plant_id
     * @param integer $customer_id
     * @param integer $grade_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $plant_id, $customer_id, $grade_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $plant_id, $customer_id, $grade_id),
        ]);
    }

    /**
     * Creates a new Cashsalerecord model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cashsalerecord();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'plant_id' => $model->plant_id, 'customer_id' => $model->customer_id, 'grade_id' => $model->grade_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Cashsalerecord model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $plant_id
     * @param integer $customer_id
     * @param integer $grade_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $plant_id, $customer_id, $grade_id)
    {
        $model = $this->findModel($id, $plant_id, $customer_id, $grade_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'plant_id' => $model->plant_id, 'customer_id' => $model->customer_id, 'grade_id' => $model->grade_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Cashsalerecord model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $plant_id
     * @param integer $customer_id
     * @param integer $grade_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $plant_id, $customer_id, $grade_id)
    {
        $this->findModel($id, $plant_id, $customer_id, $grade_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Cashsalerecord model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $plant_id
     * @param integer $customer_id
     * @param integer $grade_id
     * @return Cashsalerecord the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $plant_id, $customer_id, $grade_id)
    {
        if (($model = Cashsalerecord::findOne(['id' => $id, 'plant_id' => $plant_id, 'customer_id' => $customer_id, 'grade_id' => $grade_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
