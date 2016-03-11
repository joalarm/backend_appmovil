<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Checkin */

$this->title = 'Checkin del '.$model->Fecha;
$this->params['breadcrumbs'][] = ['label' => 'Checkins', 'url' => ['index','establecimiento' => $model->Establecimiento]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="checkin-view">

    <h1><?= Html::encode($this->title) ?></h1>
    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'Fecha',            
            'cliente.Email',
        	'cliente.Genero',
        	[
        		'label' => 'Edad',
        		'value' => $model->getEdadCliente(),
        	],
            [
            	'label' => 'Calificacion',
            	'value' => $model->getPuntajeCalificacion(),
    		],
        	[
        		'label' => 'Observaciones',
        		'value' => $model->getObservacionesCalificacion(),
        	],
        ],
    ]) ?>

</div>
