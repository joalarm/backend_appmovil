<?php

namespace app\controllers;

use Yii;
use app\models\ProductoServicio;
use app\models\BusquedaProductoServicio;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\EstProdserv;
use app\models\CatProdserv;
use app\models\Categoria;
use app\models\app\models;

/**
 * ProductoServicioController implements the CRUD actions for ProductoServicio model.
 */
class ProductoServicioController extends Controller
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
     * Lists all ProductoServicio models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BusquedaProductoServicio();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,Yii::$app->request->getQueryParam('establecimiento'));

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductoServicio model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    
    public function actionViewServicio($id)
    {
    	return $this->render('viewServicio', [
    			'model' => $this->findModel($id),
    	]);
    }

    /**
     * Creates a new ProductoServicio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductoServicio();
        $prodserv = new EstProdserv();
        $cat_prodserv = new CatProdserv();
        $categoria = new Categoria();

        if ($model->load(Yii::$app->request->post())) {
        	$model->Es_producto = 1;
        	$model->Imagen = UploadedFile::getInstance($model, 'Imagen');
        	$id = Yii::$app->request->post('establecimiento');
        	$prodserv->Est_id = $id;
        	$cat_prodserv->Cat_id = Yii::$app->request->post('Categoria')['id'];
        	if($model->save() && $model->upload()){        		
        		$prodserv->Prodserv_id = $model->id;
        		$cat_prodserv->ProdServ_id = $model->id;
        		if($cat_prodserv->save()&&$prodserv->save())
        			return $this->redirect(['view', 'id' => $model->id]);
        		else 
        			throw new \yii\base\Exception("No se pudieron guardar las relaciones");
        	} else {
        		return $this->render('create', [
        				'model' => $model,
        				'categoria' => $categoria,
        				'id' => $id,
        		]);
        	}
            
        } else {
            return $this->render('create', [
                'model' => $model,
            	'categoria' => $categoria
            ]);
        }
    }
    
    public function actionCreateServicio(){
    	$model = new ProductoServicio();
    	if ($model->load(Yii::$app->request->post())) {
    		$model->Imagen = UploadedFile::getInstance($model, 'Imagen');
    		if($model->save() && $model->upload()){
    			return $this->redirect(['view-servicio', 'id' => $model->id]);
    		} else {
    			return $this->render('createServicio', [
    					'model' => $model
    			]);
    		}
    	} else {
    		return $this->render('createServicio', [
    				'model' => $model
    		]);
    	}
    }

    /**
     * Updates an existing ProductoServicio model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $cat_prodserv = CatProdserv::find()->where(['Prodserv_Id' => $id])->one();        
        $categoria = new Categoria();
        
        if ($model->load(Yii::$app->request->post())) {
        	$model->Es_producto = 1;
        	$model->Imagen = UploadedFile::getInstance($model, 'Imagen');
        	if($model->Imagen == null){
        		$model->Imagen = Yii::$app->request->post('hiddenImagen');
        		if($model->save()){
        			$prodserv = CatProdserv::findOne($cat_prodserv->id);
        			$prodserv->Cat_id = Yii::$app->request->post('Categoria')['id'];
        			if($prodserv->save(false))
        				return $this->redirect(['view', 'id' => $model->id]);
        		}
        	}
        	if($model->save() && $model->upload()){
        		$prodserv = CatProdserv::findOne($cat_prodserv->id);
        		$prodserv->Cat_id = Yii::$app->request->post('Categoria')['id'];
        		if($prodserv->save(false))
        			return $this->redirect(['view', 'id' => $model->id]);
        	} else {
        		$categoria->id = $cat_prodserv->Cat_id;
        		return $this->render('update', [
        				'model' => $model,
        				'categoria' => $categoria
        		]);
        	}
        	
        } else {
        	$categoria->id = $cat_prodserv->Cat_id;
            return $this->render('update', [
                'model' => $model,
            	'categoria' => $categoria
            ]);
        }
    }
    
    public function actionUpdateServicio($id){
    	$model = $this->findModel($id);
    	if ($model->load(Yii::$app->request->post())) {
    		$model->Imagen = UploadedFile::getInstance($model, 'Imagen');
    		if($model->Imagen == null){
    			$model->Imagen = Yii::$app->request->post('hiddenImagen');
    			if($model->save()){
    				return $this->redirect(['view-servicio', 'id' => $model->id]);
    			}
    		}
    		if($model->save() && $model->upload()){
    			return $this->redirect(['view-servicio', 'id' => $model->id]);
    		}
    	} else {
    		return $this->render('updateServicio', [
    				'model' => $model,    				
    		]);
    	}
    }

    /**
     * Deletes an existing ProductoServicio model.
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
     * Finds the ProductoServicio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductoServicio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductoServicio::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionAsignServicio(){
    	
    	$model =  new EstProdserv();    	
    	if ($model->load(Yii::$app->request->post())){
    		$model->Est_id = Yii::$app->request->post('establecimiento');
    		if($model->save())
    			return $this->redirect(['index', 'establecimiento' => $model->Est_id]);
    	} else {
    		$establecimiento = Yii::$app->request->getQueryParam('establecimiento');
    		$query = EstProdserv::find()->select('Prodserv_id')->where(['Est_id' => $establecimiento]);
    		$items = ProductoServicio::find()
    		->where(['Es_producto' => '0'])
    		->andWhere(['not',['in', 'id',$query]])
    		->all();
	    	return $this->render('asignServicio', [
	    			'model' => $model,
	    			'items' => $items,
	    	]);
    	}
    }
    
    public function actionListServicio()
    {
    	$query = ProductoServicio::find()->select(['id', 'Nombre'])->where(['Es_producto' => '0'])->all();
    	return \yii\helpers\Json::encode($query);
    }
}
