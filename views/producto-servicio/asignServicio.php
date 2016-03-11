<?php

use yii\helpers\Html;
use app\models\app\models;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\ProductoServicio */
$establecimiento = Yii::$app->request->getQueryParam('establecimiento');
$this->title = 'Editar Servicios';
$this->params['breadcrumbs'][] = ['label' => 'Producto Servicios', 'url' => ['index','establecimiento'=>$establecimiento]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="producto-servicio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    	<div class="producto-servicio-form">

    		<?php $form = ActiveForm::begin(); ?>
    		
    		<?= Html::hiddenInput('establecimiento',$establecimiento)?>
    		
    		<?= $form->field($model, 'Prodserv_id')->dropDownList(ArrayHelper::map($items, 'id', 'Nombre'),['prompt' => ''])->label(false) ?>
    		
    		<div class="form-group">
        		<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    		</div>

    		<?php ActiveForm::end(); ?>

		</div>

</div>
