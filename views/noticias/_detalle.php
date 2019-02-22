<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Noticias */
$formatter = Yii::$app->formatter;
?>

<div class="panel panel-primary">
    <div class="panel-heading"><?= $model->titulo ?></div>
    <div class="panel-body">
        <div class="media-left">
            Meneos
        </div>
        <div class="media-body">
            <p>Enviado por: <?= $model->usuario->nombre ?> <?= $formatter->asRelativeTime($model->created_at) ?></p>
            <p>
                <?= $formatter->asHtml($model->cuerpo) ?>
            </p>
        </div>
    </div>
</div>
