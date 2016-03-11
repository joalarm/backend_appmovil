<?php

use yii\helpers\Html;
use app\models\app\models;

/* @var $this yii\web\View */
/* @var $model app\models\ProductoServicio */
$this->title = 'Crear Servicio';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="producto-servicio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formServicio', [
        'model' => $model,    	
    ]) ?>

</div>
