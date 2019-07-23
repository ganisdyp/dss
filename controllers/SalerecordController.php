<?php

namespace app\controllers;

use app\models\Cementintake;
use app\models\Custprojrel;
use app\models\Materialending;
use app\models\Materialaudit;
use app\models\Revision;
use app\models\Project;
use Yii;
use app\models\Salerecord;
use app\models\SalerecordSearch;
use app\models\Cashsalerecord;
use app\models\CashsalerecordSearch;
use app\models\GradeSearch;
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
     * Lists all Salerecord models.
     * @return mixed
     */
    public function actionIndex($plant_id = null, $date = null)
    {
        $searchModel = new SalerecordSearch();
        if ($date == date('Y-m-d')) {
            // $summary_status = 'pending';
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $plant_id, $date);
        } else {
            //    $summary_status = 'submitted';
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $plant_id, $date);
        }

        $searchModel2 = new CashsalerecordSearch();
        if ($date == date('Y-m-d')) {
            // $summary_status = 'pending';
            $dataProvider2 = $searchModel2->search(Yii::$app->request->queryParams, $plant_id, $date);
        } else {
            //    $summary_status = 'submitted';
            $dataProvider2 = $searchModel2->search(Yii::$app->request->queryParams, $plant_id, $date);
        }

        $model = new Salerecord();
        $model2 = new Cashsalerecord();
        $materialending = new Materialending();
        $cementintake = new Cementintake();

        if ($plant_id == null) {
            $plant_id = Profile::findByUserId(Yii::$app->user->identity->getId())->plant_id;
        }

        if ($model->load(Yii::$app->request->post()) || $model2->load(Yii::$app->request->post())) {
            if($model->load(Yii::$app->request->post())) {
                if ($materialending->load(Yii::$app->request->post()) && $cementintake->load(Yii::$app->request->post())) {
                    $is_holiday = $cementintake->is_holiday;
                    if ($is_holiday == 1) {
                        $materialending->is_holiday = 1;
                    } else {
                        $materialending->is_holiday = 0;
                    }
                    $checkforupdate = Materialending::findOne(['display_date' => $date, 'plant_id' => $plant_id]);
                    if (isset($checkforupdate)) {
                        $checkforupdate->silo1 = $materialending->silo1;
                        $checkforupdate->silo2 = $materialending->silo2;
                        $checkforupdate->silo3 = $materialending->silo3;
                        $checkforupdate->is_holiday = $materialending->is_holiday;
                        $checkforupdate->save();

                    } else {
                        $materialending->plant_id = $plant_id;
                        $materialending->display_date = $date;
                        $materialending->summary_status = 'pending';
                        $materialending->date_created = date('Y-m-d H:i:s');
                        $materialending->save();
                    }

                    $checkforupdate2 = Cementintake::findOne(['display_date' => $date, 'plant_id' => $plant_id]);
                    if (isset($checkforupdate2)) {
                        $checkforupdate2->silo1 = $cementintake->silo1;
                        $checkforupdate2->silo2 = $cementintake->silo2;
                        $checkforupdate2->silo3 = $cementintake->silo3;
                        $checkforupdate2->is_holiday = $cementintake->is_holiday;
                        $checkforupdate2->save();

                    } else {
                        $cementintake->plant_id = $plant_id;
                        $cementintake->display_date = $date;
                        $cementintake->summary_status = 'pending';
                        $cementintake->date_created = date('Y-m-d H:i:s');
                        $cementintake->save();
                    }

                }
                if ($model->summary_status == 'submitted') {

                    $searchModel = new SalerecordSearch();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $model->plant_id, $model->display_date);
                    $salerecords = $dataProvider->getModels();
                    $total_opc = 0;
                    $total_m3 = 0;
                    foreach ($salerecords as $salerecord) {
                        $salerecord->summary_status = 'submitted';
                        $salerecord->save();

                        $opc = ($salerecord->grade->mix_design_for_cal) * ($salerecord->m3);
                        $total_m3 += $salerecord->m3;
                        $total_opc += $opc;
                    }


                    $cashsalerecords = $dataProvider2->getModels();

                    foreach ($cashsalerecords as $cashsalerecord) {
                        $cashsalerecord->summary_status = 'submitted';
                        $cashsalerecord->save();

                        $opc = ($cashsalerecord->grade->mix_design_for_cal) * ($cashsalerecord->m3);
                        $total_m3 += $cashsalerecord->m3;
                        $total_opc += $opc;
                    }

                    // get weekday, from 0 (sunday) to 6 (saturday)
                    $lastWorkingDay = $this->findLastWorkingDay($model->display_date);

                    if ($is_holiday == 1) { // Select date = holiday
                        //      $previous_day_total = 3;
                    } else {
                        // Material Audit Calculation
                        //----Calculate
                        $material_need = $total_opc;
                        if ($total_opc == 0) {
                            $material_need_division = 0.0001;
                        } else {
                            $material_need_division = $material_need;
                        }
                        //  if ($material_need == 0) {
                        //  } else {
                        $previous_day_total = 0;
                        $today_balance = 0;
                        $today_pumped_in = 0;

                        $previous_day_total = $this->recursiveCheck($lastWorkingDay, $plant_id);

                        /*  $previous_day_materialending = Materialending::findOne(['display_date' => $lastWorkingDay, 'plant_id' => $plant_id]);
                          if (isset($previous_day_materialending)) {


                              if($previous_day_materialending->is_holiday){
                                  $lastWorkingDay = $this->findLastWorkingDay($lastWorkingDay);
                                  $previous_day_materialending = Materialending::findOne(['display_date' => $lastWorkingDay, 'plant_id' => $plant_id]);

                              }else{
                                  $previous_day_total = $previous_day_materialending->silo1 + $previous_day_materialending->silo2 + $previous_day_materialending->silo3;
                              }

                          }*/

                        $today_materialending = Materialending::findOne(['display_date' => $date, 'plant_id' => $plant_id]);
                        if (isset($today_materialending)) {
                            $today_balance = $today_materialending->silo1 + $today_materialending->silo2 + $today_materialending->silo3;
                        }

                        $today_cementintake = Cementintake::findOne(['display_date' => $date, 'plant_id' => $plant_id]);
                        if (isset($today_cementintake)) {
                            $today_pumped_in = $today_cementintake->silo1 + $today_cementintake->silo2 + $today_cementintake->silo3;
                        }

                        $actual_use = $previous_day_total + $today_pumped_in - $today_balance;

                        $checkforupdate3 = Materialaudit::findOne(['display_date' => $date, 'plant_id' => $plant_id]);

                        if (isset($checkforupdate3)) { // Update
                            $checkforupdate3->volume = $total_m3;
                            $checkforupdate3->material_need = $material_need;
                            $checkforupdate3->actual_use = $actual_use;
                            $checkforupdate3->difference_kg = $actual_use - $material_need;
                            $checkforupdate3->difference_percent = ($checkforupdate3->difference_kg / $material_need_division) * 100;
                            $checkforupdate3->date_calculated = date('Y-m-d H:i:s');
                            $checkforupdate3->save();
                        } else { // Create
                            $material_audit = new Materialaudit();
                            $material_audit->plant_id = $plant_id;
                            $material_audit->display_date = $date;
                            $material_audit->volume = $total_m3;
                            $material_audit->material_need = $material_need;
                            $material_audit->actual_use = $actual_use;
                            $material_audit->difference_kg = $actual_use - $material_need;
                            $material_audit->difference_percent = ($material_audit->difference_kg / $material_need_division) * 100;
                            $material_audit->date_calculated = date('Y-m-d H:i:s');
                            $material_audit->save();
                        }
                    }
                    //   }

                    if (Profile::findByUserId(Yii::$app->user->identity->getId())->plant_id == 0) {
                        return $this->redirect(['index?plant_id=' . $plant_id . '&date=' . $model->display_date]);
                    } else {
                        return $this->redirect(['index?date=' . $model->display_date]);
                    }


                } else {


                    $model->plant_id = $plant_id;
                    //     $model->display_date = (date('Y-m-d'));
                    $model->display_date = $date;
                    $model->save();
                    // return $this->redirect(['view', 'id' => $model->id, 'plant_id' => $model->plant_id, 'customer_id' => $model->customer_id, 'grade_id' => $model->grade_id]);
                    /* return $this->render('index', [
                         'searchModel' => $searchModel,
                         'dataProvider' => $dataProvider,
                         'model' => $model,
                     ]);
                    */
                    return $this->redirect(['index?date=' . $date]);
                }

            }
            if($model2->load(Yii::$app->request->post())){

                    $model2->plant_id = $plant_id;
                    $model2->display_date = $date;
                    $model2->save();

                    return $this->redirect(['index?date=' . $date]);
            }
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'searchModel2' => $searchModel2,
            'dataProvider' => $dataProvider,
            'dataProvider2' => $dataProvider2,
            'model' => $model,
            'model2' => $model2,
            'filter_plant' => $plant_id,
            'filter_date' => $date,
            // 'materialending' => $materialending,
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
        $display_date = Salerecord::findOne($id)->display_date;
        $this->findModel($id, $plant_id, $customer_id, $grade_id)->delete();

        if (Profile::findByUserId(Yii::$app->user->identity->getId())->plant_id == 0) {
            return $this->redirect(['index?plant_id=' . $plant_id . '&date=' . $display_date]);
        } else {
            return $this->redirect(['index?date=' . $display_date]);
        }
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

    public function actionRevision()
    {
        $model = new Salerecord();
        if ($model->load(Yii::$app->request->post())) {
            $searchModel = new SalerecordSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $model->plant_id, $model->display_date, 'submitted');
            $salerecords = $dataProvider->getModels();

            foreach ($salerecords as $salerecord) {
                $revision_model = new Revision();
                $existing_revision = Revision::findOne(['batch_no' => $salerecord->batch_no]);


                if (isset($existing_revision)) {
                    $existing_revision->delete();
                }


                $revision_model->batch_no = $salerecord->batch_no;
                $revision_model->delivery_order_no = $salerecord->delivery_order_no;
                $revision_model->summary_status = 'history';
                $revision_model->display_date = $salerecord->display_date;
                $revision_model->plant_id = $salerecord->plant_id;
                $revision_model->grade_id = $salerecord->grade_id;
                $revision_model->customer_id = $salerecord->customer_id;
                $revision_model->project_id = $salerecord->project_id;
                $revision_model->m3 = $salerecord->m3;
                $revision_model->driver_id = $salerecord->driver_id;
                $revision_model->truck_id = $salerecord->truck_id;
                $revision_model->special_condition = $salerecord->special_condition;
                $revision_model->remark = $salerecord->remark;
                $revision_model->deleted = $salerecord->deleted;


                $revision_model->save();
                $salerecord->summary_status = 'pending';
                $salerecord->save();
            }
            if (Profile::findByUserId(Yii::$app->user->identity->getId())->plant_id == 0) {
                return $this->redirect(['index?plant_id=' . $model->plant_id . '&date=' . $model->display_date]);
            } else {
                return $this->redirect(['index?date=' . $model->display_date]);
            }

        }
    }

    public function actionLoadproject()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
       // $parents[0] = 3;
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $customer_id = $parents[0];
                $out = self::getProjectList($customer_id);
                // the getSubCatList function will query the database based on the
                // cat_id and return an array like below:
                // [
                //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
                //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
                // ]
                return ['output' => $out, 'selected' => ''];
            }
        }
        return ['output' => '', 'selected' => ''];
    }

    function getProjectList($customer_id)
    {
        $projects = Project::find()->select('project.id as id, project.name as name')
            ->innerJoin('cust_proj_rel', 'cust_proj_rel.project_id = project.id AND cust_proj_rel.deleted=0')
            ->where(['cust_proj_rel.customer_id'=>$customer_id,'project.deleted'=>0])->all();
      if(isset($projects)){

      }else{
          $projects = Project::find()->where(['deleted'=>0])->all();
      }

        return $this->MapData($projects,'id','name');
    }

    protected function MapData($datas,$fieldId,$fieldName){
        $obj = [];
        foreach ($datas as $key => $value) {
            array_push($obj, ['id'=>$value->{$fieldId},'name'=>$value->{$fieldName}]);
        }
        return $obj;
    }

    function findLastWorkingDay($date)
    {
        $currentWeekDay = date("w", strtotime($date));

        switch ($currentWeekDay) {
            case "1": {  // monday

                $d = date_create($date);
                date_sub($d, date_interval_create_from_date_string("2 days"));
                $lastWorkingDay = date_format($d, "Y-m-d");

                break;
            }
            //  case "0": {  // sunday
            //    $lastWorkingDay = date("d", strtotime("-2 day"));
            //  break;
            // }
            default: {  //all other days
                $d = date_create($date);
                date_sub($d, date_interval_create_from_date_string("1 days"));
                $lastWorkingDay = date_format($d, "Y-m-d");
                break;
            }
        }
        return $lastWorkingDay;
    }

    function recursiveCheck($date, $plant_id)
    {
        //  return 9999;
        $previous_day_materialending = Materialending::findOne(['display_date' => $date, 'plant_id' => $plant_id]);
        if (isset($previous_day_materialending)) {
            if ($previous_day_materialending->is_holiday == 1) {
                $lastWorkingDay = $this->findLastWorkingDay($date);
                //  return 9000;
                return $this->recursiveCheck($lastWorkingDay, $plant_id);
            } else {
                return $previous_day_materialending->silo1 + $previous_day_materialending->silo2 + $previous_day_materialending->silo3;
            }
        } else {
            return 0;
        }
    }
}
