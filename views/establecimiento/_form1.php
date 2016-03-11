<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Ciudad;

/* @var $this yii\web\View */
/* @var $model app\models\Establecimiento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="establecimiento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Direccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Telefono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Ciudad')->dropDownList(ArrayHelper::map(Ciudad::find()->all(),'id', 'Nombre'), ['prompt'=>'']) ?>

    <?= $form->field($model, 'Icono')->fileInput() ?>

    <?= $form->field($model, 'Galeria')->textInput() ?>

    <?= $form->field($model, 'Latitud')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Longitud')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
