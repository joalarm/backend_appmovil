<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Imagen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="imagen-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Galeria')->hiddenInput()->label(false) ?>

    <?= Html::img('@web/img/galerias/'.$model->Ruta) ?>
    
    <?= Html::hiddenInput('hiddenRuta',$model->Ruta)?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
