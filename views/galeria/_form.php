<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Establecimiento;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Galeria */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="galeria-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Titulo')->textInput(['maxlength' => true]) ?>

    <?= Html::hiddenInput('hiddenEstablecimiento',Yii::$app->request->getQueryParam('establecimiento'))?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
