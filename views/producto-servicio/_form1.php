<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\EstProdserv;
use app\models\app\models;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\ProductoServicio */
/* @var $form yii\widgets\ActiveForm */
$establecimiento = Yii::$app->request->getQueryParam('establecimiento');
if(!isset($establecimiento))
	$establecimiento = (new EstProdserv())->getEstablecimiento($model->id);
?>

<div class="producto-servicio-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'Nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Descripcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Precio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Imagen')->fileInput() ?>
    
    <?= Html::hiddenInput('hiddenImagen',$model->Imagen)?>    
    
    <?= $form->field($categoria, 'id')->dropDownList(ArrayHelper::map($categoria->find()->all(), 'id', 'Nombre'), ['prompt'=>''])->label('Categoria') ?>
    
    <?= Html::hiddenInput('establecimiento',$establecimiento)?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
