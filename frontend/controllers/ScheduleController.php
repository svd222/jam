<?php

namespace frontend\controllers;

use common\helpers\Common;
use Yii;
use common\models\Schedule;
use common\helpers\RestClient;
use yii\data\ArrayDataProvider;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ScheduleController implements the CRUD actions for Schedule model.
 */
class ScheduleController extends Controller
{
    private $resource = '/schedule';

    /**
     * Lists all Schedule models.
     * @return mixed
     */
    public function actionIndex()
    {
        $allModels = RestClient::query('GET', $this->resource);
        for ($i = 0; $i < count($allModels); $i++) {
            $allModels[$i]->schedule_by_day_of_week = $this->convertSchByDayOfWeek($allModels[$i]->schedule_by_day_of_week);
        }

        $dataProvider = new ArrayDataProvider([
            'allModels' => $allModels
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $sch
     */
    protected function convertSchByDayOfWeek($sch, $asArray = true)
    {
        $sch = Json::decode(Json::encode($sch));
        $sch = join(', ', $sch);
        return $sch;
    }

    /**
     * Displays a single Schedule model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $data = RestClient::query('GET', $this->resource.'/'.$id);
        $data->schedule_by_day_of_week = $this->convertSchByDayOfWeek($data->schedule_by_day_of_week);
        return $this->render('view', [
            'model' => $data,
        ]);
    }

    /**
     * Creates a new Schedule model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Schedule();

        $stationList = RestClient::query('POST', '/station/get-list');
        $carrierList = RestClient::query('POST', '/carrier/get-list');
        $days = RestClient::query('POST', '/schedule/get-days');

        $post = Yii::$app->request->post();
        if (!empty($post)) {
            $data = $post[$model->formName()];

            $data['departure_time'] = strtotime($data['departure_time']);
            $data['arrival_time'] = strtotime($data['arrival_time']);

            $schedule_by_day_of_week = $data['schedule_by_day_of_week'];
            $data['schedule_by_day_of_week'] = (new Common())->getBitSum($schedule_by_day_of_week);

            if ($model->load($data, '') && $model->validate()) {
                $data = RestClient::query('POST', $this->resource, $data);
                return $this->redirect(['view', 'id' => $data->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'stationList' => $stationList,
            'carrierList' => $carrierList,
            'days' => $days
        ]);
    }

    /**
     * Updates an existing Schedule model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $stationList = RestClient::query('POST', '/station/get-list');
        $carrierList = RestClient::query('POST', '/carrier/get-list');
        $days = RestClient::query('POST', '/schedule/get-days');

        $post = Yii::$app->request->post();
        if (!empty($post)) {
            $data = $post[$model->formName()];

            $data['departure_time'] = strtotime($data['departure_time']);
            $data['arrival_time'] = strtotime($data['arrival_time']);

            $schedule_by_day_of_week = $data['schedule_by_day_of_week'];
            $data['schedule_by_day_of_week'] = (new Common())->getBitSum($schedule_by_day_of_week);

            if ($model->load($data, '') && $model->validate()) {
                $data = RestClient::query('PUT', $this->resource . '/' . $id, $data);
                return $this->redirect(['view', 'id' => $data->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'stationList' => $stationList,
            'carrierList' => $carrierList,
            'days' => $days
        ]);
    }

    /**
     * Finds the Schedule model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Schedule the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Schedule::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('schedule', 'The requested page does not exist.'));
    }
}
