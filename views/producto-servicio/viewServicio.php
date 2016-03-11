<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\EstProdserv;
use app\models\CatProdserv;
use app\models\Categoria;
use app\models\app\models;

/* @var $this yii\web\View */
/* @var $model app\models\ProductoServicio */
$this->title = $model->Nombre;
$this->params['breadcrumbs'][] = ['label' => 'Crear Servicio', 'url' => ['create-servicio']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="producto-servicio-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>       
        <?= Html::a('Update', ['update-servicio', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
            [
            	'label' => 'Imagen',
            	'format' => 'html',
            	'value' => Html::img('@web/img/imgprodserv/'.$model->Imagen)	
    		],            
        ],
    ]) ?>

</div>
