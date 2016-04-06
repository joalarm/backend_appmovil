<?php

namespace app\controllers;

use Yii;
use app\models\Checkin;
use app\models\BusquedaCheckin;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CheckinController implements the CRUD actions for Checkin model.
 */
class CheckinController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Checkin models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->request->getQueryParam('establecimiento') == null)
        	throw new \yii\web\HttpException('404','No se puede mostrar la pagina');
    	$searchModel = new BusquedaCheckin();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,Yii::$app->request->getQueryParam('establecimiento'));

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Checkin model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Checkin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Checkin();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Checkin model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Checkin model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Checkin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Checkin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Checkin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionListCheckins()
    {
    	$params = Yii::$app->request->queryParams;
    	$id = isset($params['id']) ? $params['id'] : null;
    	if($id != null){
	    	$query = (new \yii\db\Query())
	    			->select('checkin.*, establecimiento.Nombre, establecimiento.Direccion, establecimiento.Icono, calificacion.Puntaje, calificacion.Observaciones')
	    			->from('checkin')
	    			->leftJoin('establecimiento','checkin.Establecimiento = establecimiento.id')
	    			->leftJoin('calificacion', 'calificacion.Checkin = checkin.id')
	    			->where(['Cliente' => $id])
	    			->all();
	    	return \yii\helpers\Json::encode($query);
    	}
    	return null;
    }
    
    public function actionListCheckin()
    {
    	$params = Yii::$app->request->queryParams;
    	$id = isset($params['id']) ? $params['id'] : null;
    	if($id != null){
    		$query = (new \yii\db\Query())
    		->select(['DATE(checkin.Fecha) as Fecha', 'establecimiento.Nombre'])
    		->from('checkin')
    		->leftJoin('establecimiento','checkin.Establecimiento = establecimiento.id')
    		->where(['checkin.id' => $id])
    		->one();
    		return \yii\helpers\Json::encode($query);
    	}
    	return null;
    }
    
    public function actionCreateCheckin(){
    	$params = Yii::$app->request->queryParams;
    	$cliente = isset($params['cliente']) ? $params['cliente'] : null;
    	$establecimiento = isset($params['establecimiento']) ? $params['establecimiento'] : null;
    	$longitud = isset($params['longitud']) ? $params['longitud'] : null;
    	$latitud = isset($params['latitud']) ? $params['latitud'] : null;
    	$fecha = date("Y-m-d h:i:sa");
    	if($cliente != null && $establecimiento != null){
    		$model = new Checkin();
    		$model->Cliente = $cliente;
    		$model->Establecimiento = $establecimiento;
    		$model->Longitud = $longitud;
    		$model->Latitud = $latitud;
    		$model->Fecha = $fecha;
    		if($model->save())
    			return $model->id;
    		else
    			return -1;
    	}	
    	return 0;
    }
}
