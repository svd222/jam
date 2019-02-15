<?php

namespace frontend\controllers;

use common\helpers\RestClient;
use common\models\Station;
use Yii;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


/**
 * StationController implements the CRUD actions for Station model.
 */
class StationController extends Controller
{
    private $resource = '/station';

    /**
     * Lists all Station models.
     * @return mixed
     */
    public function actionIndex()
    {
        $allModels = RestClient::query('GET', $this->resource);

        $dataProvider = new ArrayDataProvider([
            'allModels' => $allModels
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single station model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $data = RestClient::query('GET', $this->resource.'/'.$id);

        return $this->render('view', [
            'model' => $data,
        ]);
    }

    /**
     * Creates a new Station model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Station();

        $post = Yii::$app->request->post();
        if ($model->load($post) && $model->validate()) {
            $data = RestClient::query('POST', $this->resource, $post[$model->formName()]);
            return $this->redirect(['view', 'id' => $data->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Station model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $post = Yii::$app->request->post();
        if ($model->load($post) && $model->validate()) {
            $data = RestClient::query('PUT', $this->resource.'/'.$id, $post[$model->formName()]);
            return $this->redirect(['view', 'id' => $data->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the station model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Station the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Station::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('station', 'The requested page does not exist.'));
    }
}
