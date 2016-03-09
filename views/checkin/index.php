<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Calificacion;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BusquedaCheckin */
/* @var $dataProvider yii\data\ActiveDataProvider */

$script = "$(document).ready(function() {
    			setInterval(function(){ $('#refreshButton').click(); }, 3000);});";
$this->registerJs($script);

$this->title = 'Checkins';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="checkin-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
	<?php Pjax::begin(); ?>
	<?= Html::a("Actualizar", ['index'], ['class' => 'hidden', 'id' => 'refreshButton']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'Fecha',            
            'cliente.Email',
        	'cliente.Genero',
        	[        		
        		'label' => 'Puntaje',
        		'value' => function($model){
        			$calificacion = Calificacion::find()->where(['Checkin' => $model->id])->one();
        			if(isset($calificacion->Puntaje))
        				return $calificacion->Puntaje;
        			else return "";
        		}
        	],
        	[        		
        		'label' => 'Observaciones',
        		'value' => function($model){
        			$calificacion = Calificacion::find()->where(['Checkin' => $model->id])->one();
        			if(isset($calificacion->Observaciones))
        				return $calificacion->Observaciones;
        			else return "";
        		}
        	],

            [
            	'label' => '',
            	'format' => 'html',
            	'value' => function($model){ return Html::a("Ver", ['view', 'id' => $model->id], ['class' => 'btn btn-success']);}
        	],
        ],
    ]); 
    ?>
    <?php Pjax::end(); ?>
</div>


