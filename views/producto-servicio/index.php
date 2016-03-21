<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Establecimiento;
use app\models\app\models;
use app\models\CatProdserv;
use app\models\Categoria;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BusquedaProductoServicio */
/* @var $dataProvider yii\data\ActiveDataProvider */

$establecimiento = Establecimiento::findOne(Yii::$app->request->getQueryParam('establecimiento'));
if($establecimiento==null)
{
	throw new \yii\web\HttpException('404','No se puede mostrar la pagina');
}
$this->title = 'Productos y servicios de '. $establecimiento->Nombre;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="producto-servicio-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Producto', ['create','establecimiento' => $establecimiento->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Crear Servicio', ['create-servicio'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Agregar Servicio', ['asign-servicio', 'establecimiento' => $establecimiento->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'Nombre',
            'Descripcion',
            'Precio',
        	[
        		'attribute' => 'Es_producto',
        		'label' => 'Tipo',
        		'value' => function($model){
        			if($model->Es_producto == 1)
        				return 'Producto';
        			else
        				return 'Servicio';
        		},
        		'filter' => ArrayHelper::map([['id'=> '0', 'Nombre' => 'Servicio'],['id'=> '1', 'Nombre' => 'Producto']], 'id', 'Nombre')
        	],
        	[
        		'attribute' => 'categoria.Nombre',
        		'label' => 'Categoria',
        		'value' => function($model){
        			$cat_prodserv = CatProdserv::find()->where(['Prodserv_Id' => $model->id])->one();
        			if($cat_prodserv != null){
        				$categoria = Categoria::findOne($cat_prodserv->Cat_id);
        				return $categoria->Nombre;
        			}
        			return null;
        		},
			],
        	[
            	'attribute' => 'Imagen',
            	'format' => 'html',
            	'value' => function($model){
            		return Html::img('@web/img/imgprodserv/'.$model->Imagen,['style'=>'width: 80px;']);
    			},
    			'filter' =>''	            		
    		],
            

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
