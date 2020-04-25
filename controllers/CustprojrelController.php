<?php

namespace app\controllers;

use Yii;
use app\models\Custprojrel;
use app\models\CustprojrelSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\components\BinapileRule;
use app\models\User;
use app\models\Project;
use app\models\Customer;

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
                    'delete' => ['GET','POST'],
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
                            User::ROLE_HQADMIN,
                            User::ROLE_MANAGEMENT
                        ],
                    ],
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
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($rel_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($rel_id),
        ]);
    }

    /**
     * Creates a new Custprojrel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $project = new Project();

        if ($project->load(Yii::$app->request->post())) {
            $new_project = $project->name;
            $existence_p = Project::findOne(['name'=>$new_project,'deleted'=>0]);
            if (isset($existence_p)) {
                /*foreach($existence as $e){
                    $eid = $e->id;
                }
                return $this->redirect(['customer/view?id='.$eid]);*/
                return $this->redirect(['custprojrel/create']);
            } else {
                if($project->save()){
                    return $this->redirect(['custprojrel/create']);
                }
            }
        }

        $customer = new Customer();

        if ($customer->load(Yii::$app->request->post())) {
            $new_customer = $customer->name;
            $existence_c = Customer::findOne(['name'=>$new_customer,'deleted'=>0]);
            if (isset($existence_c)) {
                /*foreach($existence as $e){
                    $eid = $e->id;
                }
                return $this->redirect(['customer/view?id='.$eid]);*/
                return $this->redirect(['custprojrel/create']);
            } else {
                if($customer->save()){
                    return $this->redirect(['custprojrel/create']);
                }
            }

        }

        $model = new Custprojrel();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
          //  return $this->redirect(['view', 'rel_id' => $model->rel_id, 'project_id' => $model->project_id, 'customer_id' => $model->customer_id]);
        return $this->redirect(['custprojrel/index']);
        }

        return $this->render('create', [
            'model' => $model,
            'customer' => $customer,
            'project' => $project,
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
    public function actionDelete($rel_id)
    {
        /*$this->findModel($id)->delete();
        return $this->redirect(['index']);*/
        $model = $this->findModel($rel_id);
        $model->deleted = 1;
        if ($model->save()) {
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Custprojrel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $rel_id
     * @return Custprojrel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($rel_id)
    {
        if (($model = Custprojrel::findOne(['rel_id' => $rel_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    function actionLoadproject()
    {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();;
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $out = [];
            if (isset($data['customer_id'])) {
                $customer_id = $data['customer_id'];
                $projects = Project::find()->select('project.id as id, project.name as name')
                    ->innerJoin('cust_proj_rel', 'cust_proj_rel.project_id = project.id AND cust_proj_rel.deleted=0')
                    ->where(['cust_proj_rel.customer_id' => $customer_id, 'project.deleted' => 0])->all();
                if (isset($projects)) {

                } else {
                    $projects = null;
                }
foreach($projects as $project){
                $out[] = $project->name;}
            }
            return $out;
        }
     }
}
