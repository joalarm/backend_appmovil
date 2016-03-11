<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Calificacion;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BusquedaCheckin */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Checkins';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="checkin-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
	<?php Pjax::begin(); ?>
	<?= Html::a("Actualizar", ['index', 'establecimiento' => Yii::$app->request->getQueryParam('establecimiento')], ['class' => 'btn btn-success', 'id' => 'refreshButton']) ?>
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
        		'label' => 'Calificacion',
        		'value' => function($model){
        			$calificacion = Calificacion::find()->where(['Checkin' => $model->id])->one();
        			if(!isset($calificacion->Puntaje))
        				return null;
        			if($calificacion->Puntaje == 1)
        				return "Malo";
        			if($calificacion->Puntaje == 2)
        				return "Regular";
        			if($calificacion->Puntaje == 3)
        				return "Bueno";
        			else return "";
        		}
        	],
        	[        		
        		'label' => 'Observaciones',
        		'value' => function($model){
        			$calificacion = Calificacion::find()->where(['Checkin' => $model->id])->one();
        			if(isset($calificacion->Observaciones))
        				return substr($calificacion->Observaciones, 0, 20)."...";
        			else return null;
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


