<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\EstProdserv;
use app\models\app\models;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\ProductoServicio */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="producto-servicio-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'Nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Descripcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Imagen')->fileInput() ?>
    
    <?= Html::hiddenInput('hiddenImagen',$model->Imagen)?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
