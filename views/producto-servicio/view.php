<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\EstProdserv;
use app\models\CatProdserv;
use app\models\Categoria;
use app\models\app\models;

/* @var $this yii\web\View */
/* @var $model app\models\ProductoServicio */
$establecimiento = (new EstProdserv())->getEstablecimiento($model->id);
$this->title = $model->Nombre;
$this->params['breadcrumbs'][] = ['label' => 'Producto Servicios', 'url' => ['index','establecimiento' => $establecimiento]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="producto-servicio-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>       
        <?= Html::a('Update', ['update', 'id' => $model->id, 'establecimiento' => $establecimiento], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'Nombre',
            'Descripcion',
            'Precio',
            [
            	'label' => 'Imagen',
            	'format' => 'html',
            	'value' => Html::img('@web/img/imgprodserv/'.$model->Imagen)	
    		],
            [
            	'label' => 'Tipo',
            	'value' => $model->getTipoNombre()
    		],
        	[
        		'label' => 'Categoria',
        		'value' => $model->getCategoria()	
    		]
        ],
    ]) ?>

</div>
