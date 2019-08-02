<?php

namespace app\controllers;

use Yii;
use app\models\Projlocarel;
use app\models\ProjlocarelSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Location;
use app\models\Project;
/**
 * ProjlocarelController implements the CRUD actions for Projlocarel model.
 */
class ProjlocarelController extends Controller
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
     * Lists all Projlocarel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjlocarelSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Projlocarel model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Projlocarel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $project = new Project();

        if ($project->load(Yii::$app->request->post()) && $project->save()) {
            return $this->redirect(['projlocarel/create']);
        }

        $location = new Location();

        if ($location->load(Yii::$app->request->post()) && $location->save()) {
            return $this->redirect(['projlocarel/create']);
        }

        $model = new Projlocarel();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->rel_id]);
        }

        return $this->render('create', [
            'model' => $model,
            'location' => $location,
            'project' => $project,
        ]);
    }

    /**
     * Updates an existing Projlocarel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->rel_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Projlocarel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Projlocarel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Projlocarel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Projlocarel::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    function actionLoadlocation()
    {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();;
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $out = [];
            if (isset($data['project_id'])) {
                $project_id = $data['project_id'];
                $locations = Location::find()->select('location.id as id, location.name as name')
                    ->innerJoin('proj_loca_rel', 'proj_loca_rel.location_id = location.id AND proj_loca_rel.deleted=0')
                    ->where(['proj_loca_rel.location_id' => $project_id, 'location.deleted' => 0])->all();
                if (isset($locations)) {

                } else {
                    $locations = null;
                }
                foreach($locations as $location){
                    $out[] = $location->name;}
            }
            return $out;
        }
    }
}
