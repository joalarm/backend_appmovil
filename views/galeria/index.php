<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Establecimiento;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BusquedaGaleria */
/* @var $dataProvider yii\data\ActiveDataProvider */
$establecimiento = Establecimiento::findOne(Yii::$app->request->getQueryParam('establecimiento'));
if($establecimiento==null)
{
	throw new \yii\web\HttpException('404','No se puede mostrar la pagina');
}
$this->title = 'Galerias de '.$establecimiento->Nombre ;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="galeria-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Galeria', ['create', 'establecimiento' => $establecimiento->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'Titulo',            

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
