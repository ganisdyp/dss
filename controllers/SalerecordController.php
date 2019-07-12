<?php

namespace app\controllers;

use Yii;
use app\models\Salerecord;
use app\models\SalerecordSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\components\BinapileRule;
use app\models\User;
use app\models\Profile;
use app\models\EntryForm;

/**
 * SalerecordController implements the CRUD actions for Salerecord model.
 */
class SalerecordController extends Controller
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
                    'delete' => ['post'],
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
     * Lists all Salerecord models.
     * @return mixed
     */
    public function actionIndex($plant_id = null,$date = null)
    {



        $searchModel = new SalerecordSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$plant_id,$date);

        $model = new Salerecord();


        if ($model->load(Yii::$app->request->post())) {

            $model->plant_id = Profile::findByUserId(Yii::$app->user->identity->getId())->plant_id;
            $model->display_date = (date('Y-m-d'));
            $model->save();
            //   return $this->redirect(['view', 'id' => $model->id, 'plant_id' => $model->plant_id, 'customer_id' => $model->customer_id, 'grade_id' => $model->grade_id]);
            /* return $this->render('index', [
                 'searchModel' => $searchModel,
                 'dataProvider' => $dataProvider,
                 'model' => $model,
             ]);*/
            return $this->redirect(['index']);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            'filter_plant' => $plant_id,
            'filter_date' => $date,
        ]);
    }


    /**
     * Displays a single Salerecord model.
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
     * Creates a new Salerecord model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Salerecord();

        if ($model->load(Yii::$app->request->post())) {

            $model->display_date = (date('Y-m-d'));
            $model->save();
            //   return $this->redirect(['view', 'id' => $model->id, 'plant_id' => $model->plant_id, 'customer_id' => $model->customer_id, 'grade_id' => $model->grade_id]);
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Salerecord model.
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
     * Deletes an existing Salerecord model.
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
     * Finds the Salerecord model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $plant_id
     * @param integer $customer_id
     * @param integer $grade_id
     * @return Salerecord the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $plant_id, $customer_id, $grade_id)
    {
        if (($model = Salerecord::findOne(['id' => $id, 'plant_id' => $plant_id, 'customer_id' => $customer_id, 'grade_id' => $grade_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionEntry()
    {
        $model = new EntryForm();

        if ($model->load(Yii::$app->request->post())) {
            // valid data received in $model
            //   echo $model->plant;
            // do something meaningful here about $model ...

            return $this->redirect(['index', 'plant' => $model->plant, 'date' => $model->date]);
        } else {
            // either the page is initially displayed or there is some validation error
            // return $this->render('index', ['model' => $model]);
        }
    }
}
