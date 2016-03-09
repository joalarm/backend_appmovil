<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Establecimiento;

/* @var $this yii\web\View */
/* @var $model app\models\Admin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Contrasena')->textInput(['maxlength' => true])->passwordInput() ?>

    <?= $form->field($model, 'Establecimiento')->dropDownList(ArrayHelper::map(Establecimiento::find()->all(), 'id', 'Nombre'), ['prompt'=>'']) ?>

    <?= $form->field($model, 'Superadmin')->dropDownList([0 => 'No', 1=> 'Si']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
