<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Establecimiento;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BusquedaAdmin */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Admins';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Admin', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'Email:email',
            [
            	'attribute' => 'Establecimiento',
            	'value' => function($model){
            			$establecimiento = Establecimiento::findOne($model->Establecimiento);
            			return $establecimiento->Nombre;
   				 },
   				 'filter' => ArrayHelper::map(Establecimiento::find()->all(), 'id', 'Nombre')		
    		],
            [            		
   				'attribute' => 'Superadmin',
            	'value' => function($model){
            		if($model->Superadmin == 1)
            			return 'Si';
            		else 
            			return 'No';  
   				 },
   				 'filter' => ArrayHelper::map([['id'=> '0', 'Nombre' => 'No'],['id'=> '1', 'Nombre' => 'Si']], 'id', 'Nombre')            		
   			],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
