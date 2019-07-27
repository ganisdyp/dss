<?php

namespace app\controllers;

use app\models\CustomerSearch;
use app\models\GradeSearch;
use app\models\Materialending;
use app\models\SalerecordSearch;
use app\models\Salerecord;
use app\models\Cashsalerecord;
use app\models\CashsalerecordSearch;
use app\models\Profile;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use edofre\fullcalendar\models\Event;
use kartik\mpdf\Pdf;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        /* return [
             'access' => [
                 'class' => AccessControl::className(),
                 'only' => ['logout'],
                 'rules' => [
                     [
                         'actions' => ['logout'],
                         'allow' => true,
                         'roles' => ['@'],
                     ],
                 ],
             ],
             'verbs' => [
                 'class' => VerbFilter::className(),
                 'actions' => [
                     'logout' => ['post'],
                 ],
             ],
         ];*/
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex($plant_id = null, $filter = null)
    {

        /* $searchModel = new SalerecordSearch();
         $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$plant_id,$date);*/
        $model = new Salerecord();
        $searchModel = new CustomerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['deleted' => 0])->andWhere(['<>', 'id', 9999])->orderBy(['name' => 'asc']);
        $dataProvider->setPagination(['pageSize' => 100]);
        $customers = $dataProvider->getModels();

        $searchModel = new GradeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['deleted' => 0])->andWhere(['<>', 'id', 9999])->orderBy(['name' => 'asc']);
        $dataProvider->setPagination(['pageSize' => 100]);
        $grades = $dataProvider->getModels();
        // print_r($dataProvider->getModels());

        return $this->render('index', [
            /*'searchModel' => $searchModel, */
            'customers' => $customers,
            'grades' => $grades,
            'filter' => $filter,
            'model' => $model,
            'filter_plant' => $plant_id,
        ]);
    }

    /**
     * Displays monthly report.
     *
     * @return string
     */
    public function actionReport($plant_id = null, $filter = null)
    {

        /* $searchModel = new SalerecordSearch();
         $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$plant_id,$date);*/
        $model = new Salerecord();
        $searchModel = new CustomerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['deleted' => 0])->andWhere(['<>', 'id', 9999])->orderBy(['name' => 'asc']);
        $dataProvider->setPagination(['pageSize' => 100]);
        $customers = $dataProvider->getModels();

        $searchModel = new GradeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['deleted' => 0])->andWhere(['<>', 'id', 9999])->orderBy(['name' => 'asc']);
        $dataProvider->setPagination(['pageSize' => 100]);
        $grades = $dataProvider->getModels();
        // print_r($dataProvider->getModels());

        return $this->render('report', [
            /*'searchModel' => $searchModel, */
            'customers' => $customers,
            'grades' => $grades,
            'filter' => $filter,
            'model' => $model,
            'filter_plant' => $plant_id,
        ]);
    }

    /**
     * Displays monthly report.
     *
     * @return string
     */
    public function actionReportcs($plant_id = null, $filter = null)
    {

        /* $searchModel = new SalerecordSearch();
         $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$plant_id,$date);*/
        $model = new Cashsalerecord();
        $searchModel = new CustomerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['deleted' => 0])->andWhere(['<>', 'id', 9999])->orderBy(['name' => 'asc']);
        $dataProvider->setPagination(['pageSize' => 100]);
        $customers = $dataProvider->getModels();

        $searchModel = new GradeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['deleted' => 0])->andWhere(['<>', 'id', 9999])->orderBy(['name' => 'asc']);
        $dataProvider->setPagination(['pageSize' => 100]);
        $grades = $dataProvider->getModels();
        // print_r($dataProvider->getModels());

        return $this->render('report-cs', [
            /*'searchModel' => $searchModel, */
            'customers' => $customers,
            'grades' => $grades,
            'filter' => $filter,
            'model' => $model,
            'filter_plant' => $plant_id,
        ]);
    }


    /**
     * Displays dashboard.
     *
     * @return string
     */
    public function actionDashboard($plant_id = null, $filter = null)
    {

        /* $searchModel = new SalerecordSearch();
         $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$plant_id,$date);*/
        $model = new Salerecord();
        $searchModel = new CustomerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['deleted' => 0])->andWhere(['<>', 'id', 0])->orderBy(['name' => 'asc']);
        $dataProvider->setPagination(['pageSize' => 100]);
        $customers = $dataProvider->getModels();

        $searchModel = new GradeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['deleted' => 0])->andWhere(['<>', 'id', 0])->orderBy(['name' => 'asc']);
        $dataProvider->setPagination(['pageSize' => 100]);
        $grades = $dataProvider->getModels();
        // print_r($dataProvider->getModels());

        // Generate grapht data set
        if ($plant_id == 0) {
            $tst = strtotime($filter . "-1");
            $format_month = date("m", $tst);
            $year = date("Y", $tst);

            // loops according to month date count + query inside each loop
            $days_in_month = cal_days_in_month(CAL_GREGORIAN, $format_month, $year);

            $year_lastmonth = date('Y', strtotime('-1 day', strtotime(date($year . '-' . $format_month . '-01'))));
            $format_lastmonth = date('m', strtotime('-1 day', strtotime(date($year . '-' . $format_month . '-01'))));
            $year_lastmonth_str = date($year_lastmonth . '-' . $format_lastmonth);
            /*   $year_lastmonth_str = date('Y-m', strtotime('last month'));

               $year_lastmonth = explode("-", $year_lastmonth_str)[0];
               $format_lastmonth = explode("-", $year_lastmonth_str)[1];*/

            $day_in_lastmonth = cal_days_in_month(CAL_GREGORIAN, $format_lastmonth, $year_lastmonth);

            $graph_data = [];
            for ($i = 1; $i < ($days_in_month + 1); $i++) {
                $timestamp = strtotime($year . "-" . $format_month . "-" . $i);
                $format_date = date("Y-m-d", $timestamp);

                // echo "FORMAT DATE:".$format_date;
                if (date("Y-m", $timestamp) != date("Y-m")) {
                    $show = true;
                } else {
                    if (date("Y-m-d", $timestamp) > date("Y-m-d")) {
                        $show = false;
                    } else {
                        $show = true;
                    }
                }

                $first_date = strtotime($year . "-" . $format_month . "-1");
                $format_first_date = date("Y-m-d", $first_date);

                $sql = "SELECT SUM(m3) as m3, DATE_FORMAT(display_date,'%d') as name FROM salerecord WHERE DATE_FORMAT(display_date,'%Y-%m-%d')>='" . $format_first_date . "' AND DATE_FORMAT(display_date,'%Y-%m-%d')<='" . $format_date . "'";
                $data = \Yii::$app->db->createCommand($sql)->queryAll();
                $exist = \Yii::$app->db->createCommand($sql)->execute();

                if ($exist != 0 && $show == true) {
                    foreach ($data as $d) {

                        $graph_data[] = [
                            intval($d["m3"])
                        ];
                    }
                } else {
                    $graph_data[] = [
                        null
                    ];
                }

            }

// LAST MONTH
            $graph_data2 = [];
            // $year_lastmonth_str = date('Y-m', strtotime('-1 months'));


            for ($i = 1; $i < ($day_in_lastmonth + 1); $i++) {
                $timestamp2 = strtotime($year_lastmonth_str . "-" . $i);
                $format_date2 = date("Y-m-d", $timestamp2);
                $show2 = true;
                $first_date2 = strtotime($year_lastmonth_str . "-1");
                $format_first_date2 = date("Y-m-d", $first_date2);

                $sql = "SELECT SUM(m3) as m3 FROM salerecord WHERE DATE_FORMAT(display_date,'%Y-%m-%d')>='" . $format_first_date2 . "' AND DATE_FORMAT(display_date,'%Y-%m-%d')<='" . $format_date2 . "'";
                $data2 = \Yii::$app->db->createCommand($sql)->queryAll();
                $exist2 = \Yii::$app->db->createCommand($sql)->execute();

                if ($exist2 != 0 && $show2 == true) {
                    foreach ($data2 as $d) {

                        $graph_data2[] = [
                            intval($d["m3"])
                        ];
                    }
                } else {
                    $graph_data2[] = [
                        null
                    ];
                }

            }
        } else {

            $tst = strtotime($filter . "-1");
            $format_month = date("m", $tst);
            $year = date("Y", $tst);

            // loops according to month date count + query inside each loop
            $days_in_month = cal_days_in_month(CAL_GREGORIAN, $format_month, $year);

            $year_lastmonth = date('Y', strtotime('-1 day', strtotime(date($year . '-' . $format_month . '-01'))));
            $format_lastmonth = date('m', strtotime('-1 day', strtotime(date($year . '-' . $format_month . '-01'))));
            $year_lastmonth_str = date($year_lastmonth . '-' . $format_lastmonth);
            /*    $year_lastmonth_str = date('Y-m', strtotime('last month'));

                $year_lastmonth = explode("-", $year_lastmonth_str)[0];
                $format_lastmonth = explode("-", $year_lastmonth_str)[1];*/

            $day_in_lastmonth = cal_days_in_month(CAL_GREGORIAN, $format_lastmonth, $year_lastmonth);

            $graph_data = [];
            for ($i = 1; $i < ($days_in_month + 1); $i++) {
                $timestamp = strtotime($year . "-" . $format_month . "-" . $i);
                $format_date = date("Y-m-d", $timestamp);

                if (date("Y-m", $timestamp) != date("Y-m")) {
                    $show = true;
                } else {
                    if (date("Y-m-d", $timestamp) > date("Y-m-d")) {
                        $show = false;
                    } else {
                        $show = true;
                    }
                }


                $first_date = strtotime($year . "-" . $format_month . "-1");
                $format_first_date = date("Y-m-d", $first_date);

                $sql = "SELECT SUM(m3) as m3, DATE_FORMAT(display_date,'%d') as name FROM salerecord WHERE plant_id= " . $plant_id . " AND DATE_FORMAT(display_date,'%Y-%m-%d')>='" . $format_first_date . "' AND DATE_FORMAT(display_date,'%Y-%m-%d')<='" . $format_date . "'";
                $data = \Yii::$app->db->createCommand($sql)->queryAll();
                $exist = \Yii::$app->db->createCommand($sql)->execute();

                if ($exist != 0 && $show == true) {
                    foreach ($data as $d) {

                        $graph_data[] = [
                            intval($d["m3"])
                        ];
                    }
                } else {
                    $graph_data[] = [
                        null
                    ];
                }

            }

// LAST MONTH
            $graph_data2 = [];
            // $year_lastmonth_str = date('Y-m', strtotime('-1 months'));


            for ($i = 1; $i < ($day_in_lastmonth + 1); $i++) {
                $timestamp2 = strtotime($year_lastmonth_str . "-" . $i);
                $format_date2 = date("Y-m-d", $timestamp2);
                $show2 = true;
                $first_date2 = strtotime($year_lastmonth_str . "-1");
                $format_first_date2 = date("Y-m-d", $first_date2);

                $sql = "SELECT SUM(m3) as m3 FROM salerecord WHERE plant_id= " . $plant_id . " AND DATE_FORMAT(display_date,'%Y-%m-%d')>='" . $format_first_date2 . "' AND DATE_FORMAT(display_date,'%Y-%m-%d')<='" . $format_date2 . "'";
                $data2 = \Yii::$app->db->createCommand($sql)->queryAll();
                $exist2 = \Yii::$app->db->createCommand($sql)->execute();

                if ($exist2 != 0 && $show2 == true) {
                    foreach ($data2 as $d) {

                        $graph_data2[] = [
                            intval($d["m3"])
                        ];
                    }
                } else {
                    $graph_data2[] = [
                        null
                    ];
                }

            }
        }
        return $this->render('dashboard', [
            /*'searchModel' => $searchModel, */
            'customers' => $customers,
            'grades' => $grades,
            'filter' => $filter,
            'model' => $model,
            'filter_plant' => $plant_id,
            'data' => $graph_data,
            'data2' => $graph_data2,
        ]);
    }

    /**
     * Displays monthly report.
     *
     * @return string
     */
    public function actionDriver($plant_id = null, $filter = null, $driver_id = null)
    {

        /* $searchModel = new SalerecordSearch();
         $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$plant_id,$date);*/

        $model = new Salerecord();
        $searchModel = new CustomerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['deleted' => 0])->andWhere(['<>', 'id', 9999])->orderBy(['name' => 'asc']);
        $dataProvider->setPagination(['pageSize' => 100]);
        $customers = $dataProvider->getModels();

        $searchModel = new GradeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['deleted' => 0])->andWhere(['<>', 'id', 9999])->orderBy(['name' => 'asc']);
        $dataProvider->setPagination(['pageSize' => 100]);
        $grades = $dataProvider->getModels();


        $date_arr = explode("-", $filter);
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

        $year_month_str = $year . "-" . $format_month;

        $searchModel = new SalerecordSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if ($plant_id == 0) {
            $dataProvider->query->where(['deleted' => 0, 'driver_id' => $driver_id, 'DATE_FORMAT(display_date,"%Y-%m")' => $year_month_str])->orderBy(['display_date' => 'asc', 'batch_no' => 'asc']);
        } else {
            $dataProvider->query->where(['deleted' => 0, 'driver_id' => $driver_id, 'DATE_FORMAT(display_date,"%Y-%m")' => $year_month_str, 'plant_id' => $plant_id])->orderBy(['display_date' => 'asc', 'batch_no' => 'asc']);
        }
        $dataProvider->setPagination(['pageSize' => 100]);
        $driver_trip = $dataProvider->getModels();
        // print_r($dataProvider->getModels());

        return $this->render('driver-trip', [
            /*'searchModel' => $searchModel, */
            'customers' => $customers,
            'grades' => $grades,
            'drivertrips' => $driver_trip,
            'filter' => $filter,
            'model' => $model,
            'filter_plant' => $plant_id,
            'filter_driver' => $driver_id,
        ]);
    }

    public function actionEvents($plant_id = null, $start, $end)
    {

        $user_role = Yii::$app->user->identity->getRole();

// Specify the start date. This date can be any English textual format
        $date_from = $start;
        $date_from = strtotime($date_from); // Convert date to a UNIX timestamp

// Specify the end date. This date can be any English textual format
        $date_to = $end;
        $date_to = strtotime($date_to); // Convert date to a UNIX timestamp

// Loop from the start date to end date and output all dates inbetween
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        for ($i = $date_from; $i <= $date_to; $i += 86400) {
            $display_date = date("Y-m-d", $i);

            $pending_exist = Salerecord::findOne(['plant_id' => $plant_id, 'display_date' => $display_date, 'summary_status' => 'pending']);
            $submitted_exist = Salerecord::findOne(['plant_id' => $plant_id, 'display_date' => $display_date, 'summary_status' => 'submitted']);
            $check_holiday = Materialending::findOne(['plant_id' => $plant_id, 'display_date' => $display_date]);

            if (isset($check_holiday)) {
                $is_holiday = $check_holiday->is_holiday;

                if ($is_holiday == 1) {
                    $img_src = 'holiday-icon.png';
                    $events[] = new Event([
                        'id' => uniqid(),
                        'title' => $img_src,
                        'start' => $display_date,
                        'end' => $display_date,
                        'editable' => false,
                        'startEditable' => false,
                        'durationEditable' => true,
                        'url' => 'salerecord/index?plant_id=' . $plant_id . '&date=' . $display_date,
                        'backgroundColor' => 'transparent',
                        'borderColor' => 'transparent',
                    ]);
                } else {
                    if (isset($pending_exist) || isset($submitted_exist)) {
                        if (isset($pending_exist)) {
                            $img_src = 'pending-icon-2.png';
                            $events[] = new Event([
                                'id' => uniqid(),
                                'title' => $img_src,
                                'start' => $display_date,
                                'end' => $display_date,
                                'editable' => false,
                                'startEditable' => false,
                                'durationEditable' => true,
                                'url' => 'salerecord/index?plant_id=' . $plant_id . '&date=' . $display_date,
                                'backgroundColor' => 'transparent',
                                'borderColor' => 'transparent',
                            ]);

                        } else {
                            $img_src = 'submitted-icon.png';

                            if($user_role!=1){
                                $events[] = new Event([
                                    'id' => uniqid(),
                                    'title' => $img_src,
                                    'start' => $display_date.'T12:30:00',
                                    'end' => $display_date.'T13:30:00',
                                    'editable' => false,
                                    'startEditable' => false,
                                    'durationEditable' => true,
                                    'url' => 'salerecord/index?plant_id=' . $plant_id . '&date=' . $display_date,
                                    'backgroundColor' => 'transparent',
                                    'borderColor' => 'transparent',
                                ]);
                                $events[] = new Event([
                                    'id' => uniqid(),
                                    'title' => 'pdf-icon-new.png',
                                    'start' => $display_date.'T14:30:00',
                                    'end' => $display_date.'T15:30:00',
                                    'editable' => false,
                                    'startEditable' => false,
                                    'durationEditable' => true,
                                    'url' => 'salerecord/pdf?plant_id=' . $plant_id . '&date=' . $display_date,
                                    'backgroundColor' => 'transparent',
                                    'borderColor' => 'transparent',
                                ]);
                            }else{
                                $events[] = new Event([
                                    'id' => uniqid(),
                                    'title' => $img_src,
                                    'start' => $display_date,
                                    'end' => $display_date,
                                    'editable' => false,
                                    'startEditable' => false,
                                    'durationEditable' => true,
                                    'url' => 'salerecord/index?plant_id=' . $plant_id . '&date=' . $display_date,
                                    'backgroundColor' => 'transparent',
                                    'borderColor' => 'transparent',
                                ]);
                            }
                        }
                    }
                }
            }

        }
        return $events;


//];


        /* return [

             new Event([
                 'id'               => uniqid(),
                 'title'            => 'submitted-icon.png',
                 'start'            => $start,
                 'end'              => $start,
                 'editable'         => false,
                 'startEditable'    => false,
                 'durationEditable' => true,
                 'url' => 'salerecord/index?plant_id='.$plant_id.'&date='.$start,
                 'backgroundColor' => 'transparent',
                 'borderColor' => 'transparent',
             ]),

             // Only duration editable
             new Event([
                 'id'               => uniqid(),
                 'title'            => 'pending-icon.png',
                 'start'            => '2019-07-03',
                 'end'              => '2019-07-03',
                 'startEditable'    => false,
                 'durationEditable' => true,
                 'url' => 'salerecord/index?plant_id='.$plant_id.'&date=2019-07-03',
                 'backgroundColor' => 'transparent',
                 'borderColor' => 'transparent',
             ]),

         ];*/
    }

    public function actionPdf($plant_id = null, $filter = null)
    {
        $model = new Salerecord();
        $searchModel = new CustomerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['deleted' => 0])->andWhere(['<>', 'id', 9999])->orderBy(['name' => 'asc']);
        $dataProvider->setPagination(['pageSize' => 100]);
        $customers = $dataProvider->getModels();

        $searchModel = new GradeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['deleted' => 0])->andWhere(['<>', 'id', 9999])->orderBy(['name' => 'asc']);
        $dataProvider->setPagination(['pageSize' => 100]);
        $grades = $dataProvider->getModels();
        // print_r($dataProvider->getModels());

        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('_report-pdf', [
            'customers' => $customers,
            'grades' => $grades,
            'filter' => $filter,
            'model' => $model,
            'filter_plant' => $plant_id,
        ]);

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_LANDSCAPE,
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
            'options' => ['title' => 'Preview Salerecord: '.$plant_id],
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
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {


        if (!Yii::$app->user->isGuest) {

            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            /* $user_role = Yii::$app->user->identity->getRole();
             $user_plant = Profile::findByUserId(Yii::$app->user->identity->getId())->plant->name;
             $user_plant_id = Profile::findByUserId(Yii::$app->user->identity->getId())->plant_id;
             return $this->redirect('index?plant_id='.$user_plant_id.'&'.'filter='.(date('Y-M'))); */
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
