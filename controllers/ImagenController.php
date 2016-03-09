<?php

namespace app\controllers;

use Yii;
use app\models\Imagen;
use app\models\BusquedaImagen;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ImagenController implements the CRUD actions for Imagen model.
 */
class ImagenController extends Controller
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
     * Lists all Imagen models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BusquedaImagen();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, Yii::$app->request->getQueryParam('Galeria'));

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Imagen model.
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
     * Creates a new Imagen model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Imagen();

        if ($model->load(Yii::$app->request->post())) {
        	$model->Ruta = UploadedFile::getInstance($model, 'Ruta');
        	$model->Galeria = Yii::$app->request->post('hiddenGaleria');
        	if($model->save() && $model->upload())
            	return $this->redirect(['view', 'id' => $model->id]);
        	else 
        		throw new \yii\base\Exception(var_dump($model));
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Imagen model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
        	$model->scenario = 'actualizar';
        	if($model->save())
            	return $this->redirect(['view', 'id' => $model->id]);
        	else
        		throw new \yii\base\Exception(var_dump($model));
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Imagen model.
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
     * Finds the Imagen model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Imagen the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Imagen::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
