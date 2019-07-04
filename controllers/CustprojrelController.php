<?php

namespace app\controllers;

use Yii;
use app\models\Custprojrel;
use app\models\CustprojrelSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CustprojrelController implements the CRUD actions for Custprojrel model.
 */
class CustprojrelController extends Controller
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
     * Lists all Custprojrel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CustprojrelSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Custprojrel model.
     * @param integer $rel_id
     * @param integer $project_id
     * @param integer $customer_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($rel_id, $project_id, $customer_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($rel_id, $project_id, $customer_id),
        ]);
    }

    /**
     * Creates a new Custprojrel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Custprojrel();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'rel_id' => $model->rel_id, 'project_id' => $model->project_id, 'customer_id' => $model->customer_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Custprojrel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $rel_id
     * @param integer $project_id
     * @param integer $customer_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($rel_id, $project_id, $customer_id)
    {
        $model = $this->findModel($rel_id, $project_id, $customer_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'rel_id' => $model->rel_id, 'project_id' => $model->project_id, 'customer_id' => $model->customer_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Custprojrel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $rel_id
     * @param integer $project_id
     * @param integer $customer_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($rel_id, $project_id, $customer_id)
    {
        $this->findModel($rel_id, $project_id, $customer_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Custprojrel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $rel_id
     * @param integer $project_id
     * @param integer $customer_id
     * @return Custprojrel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($rel_id, $project_id, $customer_id)
    {
        if (($model = Custprojrel::findOne(['rel_id' => $rel_id, 'project_id' => $project_id, 'customer_id' => $customer_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
