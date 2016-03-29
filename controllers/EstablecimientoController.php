<?php

namespace app\controllers;

use Yii;
use app\models\Establecimiento;
use app\models\BusquedaEstablecimiento;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * EstablecimientoController implements the CRUD actions for Establecimiento model.
 */
class EstablecimientoController extends Controller
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
     * Lists all Establecimiento models.
     * @return mixed
     */
    public function actionIndex()
    {
    	if(isset(Yii::$app->user->identity->Establecimiento)){
    		return $this->redirect(['view', 'id' => Yii::$app->user->identity->Establecimiento]);
    	}
    	
    	$searchModel = new BusquedaEstablecimiento();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Establecimiento model.
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
     * Creates a new Establecimiento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Establecimiento();
		$model->scenario = 'create';
        
        if ($model->load(Yii::$app->request->post())) {
        	$model->Icono = UploadedFile::getInstance($model, 'Icono');
        	if($model->save() && $model->upload()){
            	return $this->redirect(['view', 'id' => $model->id]);
        	} else {        		
        		return $this->render('create', [
                'model' => $model,
            ]);
        	}
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Establecimiento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
    	$model = $this->findModel($id);
    	$model->scenario = 'update';
        $model->Icono = UploadedFile::getInstance($model, 'Icono');
        if ($model->load(Yii::$app->request->post())) {
        	$model->Icono = UploadedFile::getInstance($model, 'Icono');
        	if($model->Icono == null){
        		$model->Icono = Yii::$app->request->post('hiddenIcono');
        		if($model->save())
        			return $this->redirect(['view', 'id' => $model->id]);
        	}
        	if($model->save() && $model->upload()){
        		return $this->redirect(['view', 'id' => $model->id]);
        	} else {
        		return $this->render('update', [
        				'model' => $model,
        		]);
        	}
            
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Establecimiento model.
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
     * Finds the Establecimiento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Establecimiento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Establecimiento::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    


    public function actionListEstablecimiento()
    {
    	$params = Yii::$app->request->queryParams;
    	$model = Establecimiento::find()->select(['id','Nombre','Direccion','Telefono','Icono'])->all();
    	return \yii\helpers\Json::encode($model);
    }
    
}
