<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Establecimiento */

$this->title = $model->Nombre;
$this->params['breadcrumbs'][] = ['label' => 'Establecimientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="establecimiento-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Ver Productos-Servicios', ['producto-servicio/', 'establecimiento' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Ver Galerias', ['galeria/', 'establecimiento' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Ver Checkins', ['checkin/', 'establecimiento' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
            'Direccion',
            'Telefono',
            'Email:email',
            [
            	'label' => 'Ciudad',
            	'value' => $model->ciudad->Nombre,
            ],
            [
            	'label' => 'Icono',
            	'format' => 'html',
            	'value' => Html::img('@web/img/establecimientos/'.$model->Icono)
            ],
            'Latitud',
            'Longitud',
        ],
    ]) ?>

</div>
