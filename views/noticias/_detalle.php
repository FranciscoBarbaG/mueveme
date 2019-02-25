<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Noticias */
$formatter = Yii::$app->formatter;
$url = Url::to(['noticias/menear']);
$js = <<<EOT
    $('.boton').click(function (event) {
        var el = $(this);
        var id = el.data('key');
        $.ajax({
            url: '$url',
            data: { id: id },
            success: function (data) {
                $('#movim-' + id).html(data);
                el.attr('disabled', true);
            },
            // error: function (xhr, status, error) {
            //     console.log(status);
            // }
        });
    });
EOT;
$this->registerJs($js);
?>

<div class="panel panel-info">
    <div class="panel-heading">
        <?= Html::a($model->titulo, $model->enlace) ?>
    </div>
    <div class="panel-body">
        <div class="media-left text-center">
            <?= Html::button('Movimientos', ['class' => 'btn-primary boton', 'id' => 'boton-' . $model->id, 'data-key' => $model->id]) ?>
            <span id="<?= 'movim-' . $model->id ?>"><?= Html::encode($model->movimientos) ?></span>
        </div>
        <div class="media-body">
            <p>Enviado por: <?= $model->usuario->nombre ?> <?= $formatter->asRelativeTime($model->created_at) ?></p>
            <p>
                <?= $formatter->asHtml($model->cuerpo) ?>
            </p>
        </div>
        <?php if ($model->tieneImagen()): ?>
            <div class="media-right">
                <?= Html::img($model->urlImagen) ?>
            </div>
        <?php endif ?>
    </div>
</div>
