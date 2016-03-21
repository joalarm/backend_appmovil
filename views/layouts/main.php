<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
if(!Yii::$app->user->isGuest && Yii::$app->user->identity->Superadmin == 1)
	$menu = '<li>'
            .Html::a("Ciudades",['ciudad/index'])
            .'</li>'
            .'<li>'
            .Html::a("Categorias",['categoria/index'])
            .'</li>'
            .'<li>'
            .Html::a("Agregar Servicio",['producto-servicio/create-servicio'])
            .'</li>'
            .'<li>'
            .Html::a("Administradores",['admin/index'])
            .'</li>';
else 
	$menu = '';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => utf8_encode('APP Movil Rumbero Movil'),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [            
            Yii::$app->user->isGuest ? (
                ['label' => 'Iniciar Sesion', 'url' => ['/site/login']]
            ) : (
                '<li>'
            	.Html::a("Establecimientos",['establecimiento/index'])
            	.'</li>'
            	.$menu
            	.'<li>'            		
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Cerrar Sesion (' . Yii::$app->user->identity->Email . ')',
                    ['class' => 'btn btn-link']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([        	
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
