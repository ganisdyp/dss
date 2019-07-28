<?php

namespace app\controllers;

use app\models\Fuelefficiency;
use Yii;
use app\models\Salerecord;
use app\models\Cashsalerecord;
use app\models\Truckexpense;
use app\models\Dieselexpense;
use app\models\TruckexpenseSearch;
use app\models\DieselexpenseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\User;
use yii\filters\AccessControl;
use app\components\BinapileRule;
use kartik\mpdf\Pdf;
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
                            User::ROLE_HQADMIN,
                            User::ROLE_MANAGEMENT
                        ],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Truckexpense models.
     * @return mixed
     */
    public function actionIndex($truck_id = null, $month = null)
    {
        $original_month = $month;
        $month = $this->getFormatMonth($month);

        $searchModel = new TruckexpenseSearch();
        $searchModel2 = new DieselexpenseSearch();
        // $summary_status = 'pending';
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $truck_id, $month);
        $dataProvider2 = $searchModel2->search(Yii::$app->request->queryParams, $truck_id, $month);

        $model = new Truckexpense();
        $model2 = new Dieselexpense();
        $fuelefficiency = new Fuelefficiency();

        if ($fuelefficiency->load(Yii::$app->request->post())) {
            $checkforupdate = Fuelefficiency::findOne(['display_month' => $month . '-01', 'truck_id' => $truck_id]);
            if (isset($checkforupdate)) {
                $checkforupdate->litre_per_m3 = $fuelefficiency->litre_per_m3;
                $checkforupdate->rm_per_m3 = $fuelefficiency->rm_per_m3;
                $checkforupdate->save();

            } else {
                // $fuelefficiency->truck_id = $truck_id;
                $fuelefficiency->display_month = $month . '-01';
                $fuelefficiency->date_reported = date('Y-m-d H:i:s');
                $fuelefficiency->save();
            }

        }
        if ($model->load(Yii::$app->request->post())) {

            $model->truck_id = $truck_id;
            $model->save();

            return $this->redirect(['index?truck_id=' . $truck_id . '&month=' . $original_month]);
        }

        if ($model2->load(Yii::$app->request->post())) {

            $model2->truck_id = $truck_id;
            $model2->save();

            return $this->redirect(['index?truck_id=' . $truck_id . '&month=' . $original_month]);
        }

        // }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'searchModel2' => $searchModel2,
            'dataProvider' => $dataProvider,
            'dataProvider2' => $dataProvider2,
            'model' => $model,
            'model2' => $model2,
            'filter_truck' => $truck_id,
            'filter_date' => $original_month,
            'month' => $month,
            // 'materialending' => $materialending,
        ]);
    }

    public function actionReport($truck_id = null, $month = null)
    {
        $original_month = $month;
        $month = $this->getFormatMonth($month);

     //   $searchModel2 = new DieselexpenseSearch();
        // $summary_status = 'pending';
    //    $dataProvider2 = $searchModel2->search(Yii::$app->request->queryParams, $truck_id, $month);
        $dieselexpenses = Dieselexpense::find()->select('sum(cost) as total_cost,truck_id')->where(['DATE_FORMAT(display_date,"%Y-%m")' => $month])->orderBy(['display_date' => 'asc', 'id' => 'asc'])->groupBy('truck_id')->createCommand()->queryAll();
       // print_r($dieselexpenses);
        $volume_delivered = [];
        for($i=0;$i<count($dieselexpenses);$i++){
            $volume_delivered[] = Salerecord::find()->select('sum(m3) as volume_delivered')->where(['DATE_FORMAT(display_date,"%Y-%m")' => $month,'truck_id'=>$dieselexpenses[$i]["truck_id"]])->orderBy(['display_date' => 'asc', 'id' => 'asc'])->groupBy('truck_id')->createCommand()->queryOne();
            $volume_delivered_cs[] = Cashsalerecord::find()->select('sum(m3) as volume_delivered')->where(['DATE_FORMAT(display_date,"%Y-%m")' => $month,'truck_id'=>$dieselexpenses[$i]["truck_id"]])->orderBy(['display_date' => 'asc', 'id' => 'asc'])->groupBy('truck_id')->createCommand()->queryOne();
        }
        for($i=0;$i<count($volume_delivered);$i++){
            $cs_volume_delivered = 0;
            if(isset($volume_delivered_cs[$i]["volume_delivered"])) {
                $cs_volume_delivered = $volume_delivered_cs[$i]["volume_delivered"];
            }

            $dieselexpenses[$i]["volume_delivered"] = $volume_delivered[$i]["volume_delivered"]+$cs_volume_delivered;
        }
      // print_r($dieselexpenses);

        // }

        return $this->render('report', [

            'filter_date' => $original_month,
            'month' => $month,
       'dieselexpenses'=>$dieselexpenses,

            // 'materialending' => $materialending,
        ]);
    }

    public function actionReportpdf($truck_id = null, $month = null)
    {
        $original_month = $month;
        $month = $this->getFormatMonth($month);

        //   $searchModel2 = new DieselexpenseSearch();
        // $summary_status = 'pending';
        //    $dataProvider2 = $searchModel2->search(Yii::$app->request->queryParams, $truck_id, $month);
        $dieselexpenses = Dieselexpense::find()->select('sum(cost) as total_cost,truck_id')->where(['DATE_FORMAT(display_date,"%Y-%m")' => $month])->orderBy(['display_date' => 'asc', 'id' => 'asc'])->groupBy('truck_id')->createCommand()->queryAll();
        // print_r($dieselexpenses);
        $volume_delivered = [];
        for($i=0;$i<count($dieselexpenses);$i++){
            $volume_delivered[] = Salerecord::find()->select('sum(m3) as volume_delivered')->where(['DATE_FORMAT(display_date,"%Y-%m")' => $month,'truck_id'=>$dieselexpenses[$i]["truck_id"]])->orderBy(['display_date' => 'asc', 'id' => 'asc'])->groupBy('truck_id')->createCommand()->queryOne();
            $volume_delivered_cs[] = Cashsalerecord::find()->select('sum(m3) as volume_delivered')->where(['DATE_FORMAT(display_date,"%Y-%m")' => $month,'truck_id'=>$dieselexpenses[$i]["truck_id"]])->orderBy(['display_date' => 'asc', 'id' => 'asc'])->groupBy('truck_id')->createCommand()->queryOne();
        }
        for($i=0;$i<count($volume_delivered);$i++){
            $cs_volume_delivered = 0;
            if(isset($volume_delivered_cs[$i]["volume_delivered"])) {
                $cs_volume_delivered = $volume_delivered_cs[$i]["volume_delivered"];
            }

            $dieselexpenses[$i]["volume_delivered"] = $volume_delivered[$i]["volume_delivered"]+$cs_volume_delivered;
        }
        // print_r($dieselexpenses);

        // }

        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('_report-pdf', [
            'filter_date' => $original_month,
            'month' => $month,
            'dieselexpenses'=>$dieselexpenses,
        ]);

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@app/web/css/pdf.css',
            // any css to be embedded if required
            'cssInline' => 'table,tr,td{border:none !important;}',
            // set mPDF properties on the fly
            'options' => ['title' => 'Preview Truck Expense: '.$truck_id],
            // call mPDF methods on the fly
            'methods' => [
                //'SetHeader'=>[''],
                //'SetFooter'=>['{PAGENO}'],
            ]
        ]);

        // return the pdf output as per the destination setting
        return $pdf->render();
    }

    public function actionPdf($truck_id = null, $month = null)
    {
        $original_month = $month;
        $month = $this->getFormatMonth($month);

        $searchModel = new TruckexpenseSearch();
        $searchModel2 = new DieselexpenseSearch();
        // $summary_status = 'pending';
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $truck_id, $month);
        $dataProvider2 = $searchModel2->search(Yii::$app->request->queryParams, $truck_id, $month);

        $model = new Truckexpense();
        $model2 = new Dieselexpense();
        $fuelefficiency = new Fuelefficiency();

        // }


        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('_pdf', [
            'searchModel' => $searchModel,
            'searchModel2' => $searchModel2,
            'dataProvider' => $dataProvider,
            'dataProvider2' => $dataProvider2,
            'model' => $model,
            'model2' => $model2,
            'filter_truck' => $truck_id,
            'filter_date' => $original_month,
            'month' => $month,
        ]);

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@app/web/css/pdf.css',
            // any css to be embedded if required
            'cssInline' => 'table,tr,td{border:none !important;}',
            // set mPDF properties on the fly
            'options' => ['title' => 'Preview Truck Expense: '.$truck_id],
            // call mPDF methods on the fly
            'methods' => [
                //'SetHeader'=>[''],
                //'SetFooter'=>['{PAGENO}'],
            ]
        ]);

        // return the pdf output as per the destination setting
        return $pdf->render();
    }

    /**
     * Lists all Truckexpense models.
     * @return mixed
     */
    /*  public function actionIndex()
      {
          $searchModel = new TruckexpenseSearch();
          $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

          return $this->render('index', [
              'searchModel' => $searchModel,
              'dataProvider' => $dataProvider,
          ]);
      }*/

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

    public function getFormatMonth($month)
    {
        $date_arr = explode("-", $month);
        $year = $date_arr[0];
        $month = $date_arr[1];
        if ($month == 'Jan') {
            $format_month = '01';
        } else if ($month == 'Feb') {
            $format_month = '02';
        } else if ($month == 'Mar') {
            $format_month = '03';
        } else if ($month == 'Apr') {
            $format_month = '04';
        } else if ($month == 'May') {
            $format_month = '05';
        } else if ($month == 'Jun') {
            $format_month = '06';
        } else if ($month == 'Jul') {
            $format_month = '07';
        } else if ($month == 'Aug') {
            $format_month = '08';
        } else if ($month == 'Sep') {
            $format_month = '09';
        } else if ($month == 'Oct') {
            $format_month = '10';
        } else if ($month == 'Nov') {
            $format_month = '11';
        } else if ($month == 'Dec') {
            $format_month = '12';
        }
        return $year . '-' . $format_month;
    }
}
