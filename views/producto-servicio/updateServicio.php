<?php

use yii\helpers\Html;
use app\models\EstProdserv;
use app\models\Categoria;

/* @var $this yii\web\View */
/* @var $model app\models\ProductoServicio */
$this->title = 'Update Producto Servicio: ' . ' ' . $model->Nombre;
$this->params['breadcrumbs'][] = ['label' => 'Producto Servicios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="producto-servicio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formServicio', [
        'model' => $model,
    ]) ?>

</div>
