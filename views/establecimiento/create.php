<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Establecimiento */

$this->title = 'Create Establecimiento';
$this->params['breadcrumbs'][] = ['label' => 'Establecimientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="establecimiento-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
