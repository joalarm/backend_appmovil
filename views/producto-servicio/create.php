<?php

use yii\helpers\Html;
use app\models\EstProdserv;
use app\models\app\models;

/* @var $this yii\web\View */
/* @var $model app\models\ProductoServicio */
$establecimiento = Yii::$app->request->getQueryParam('establecimiento');
$this->title = 'Create Producto Servicio';
$this->params['breadcrumbs'][] = ['label' => 'Producto Servicios', 'url' => ['index','establecimiento'=>$establecimiento]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="producto-servicio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    	'categoria' => $categoria
    ]) ?>

</div>
