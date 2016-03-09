<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BusquedaCheckin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="checkin-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'Fecha') ?>

    <?= $form->field($model, 'Longitud') ?>

    <?= $form->field($model, 'Latitud') ?>

    <?= $form->field($model, 'Cliente') ?>

    <?php // echo $form->field($model, 'Establecimiento') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
