<?php

namespace app\controllers;

use Yii;
use app\models\Dieselexpense;
use app\models\DieselexpenseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\User;
use yii\filters\AccessControl;
use app\components\BinapileRule;
/**
 * DieselexpenseController implements the CRUD actions for Dieselexpense model.
 */
class DieselexpenseController extends Controller
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
                    'delete' => ['get'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                // We will override the default rule config with the new AccessRule class
                'ruleConfig' => [
                    'class' => BinapileRule::className(),
                ],
                'only' => ['index', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        // Allow plant admin, moderators and admins to create
                        'roles' => [
                            User::ROLE_PLANTADMIN,
                            User::ROLE_HQADMIN,
                            User::ROLE_MANAGEMENT
                        ],
                    ],
                    [
                        'actions' => ['update', 'create', 'delete'],
                        'allow' => true,
                        // Allow moderators and admins to update
                        'roles' => [
                            User::ROLE_PLANTADMIN,
                            User::ROLE_MANAGEMENT
                        ],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Dieselexpense models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DieselexpenseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Dieselexpense model.
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
     * Creates a new Dieselexpense model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Dieselexpense();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'truck_id' => $model->truck_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Dieselexpense model.
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
     * Deletes an existing Dieselexpense model.
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
     * Finds the Dieselexpense model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $truck_id
     * @return Dieselexpense the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $truck_id)
    {
        if (($model = Dieselexpense::findOne(['id' => $id, 'truck_id' => $truck_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
