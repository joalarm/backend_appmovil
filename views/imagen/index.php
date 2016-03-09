<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Galeria;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BusquedaImagen */
/* @var $dataProvider yii\data\ActiveDataProvider */
$galeria= Galeria::findOne(Yii::$app->request->getQueryParam('Galeria'));
if($galeria==null)
{
	throw new \yii\web\HttpException('404','No se puede mostrar la pagina');
}
$this->title = 'Imagenes de '. $galeria->Titulo;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="imagen-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Agregar Imagen', ['create', "Galeria" => $galeria->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Volver a Galerias', ['galeria/', "establecimiento" => $galeria->Establecimiento], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'Titulo',
            [
            	'attribute' => 'Imagen',
            	'format' => 'html',
            	'value' => function($model){
            		return Html::img('@web/img/galerias/'.$model->Ruta,['style'=>'width: 200px;']);
    			},
    			'filter' =>''	            		
    		],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
