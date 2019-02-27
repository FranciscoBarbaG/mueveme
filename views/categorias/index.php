<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategoriasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categorias';
$this->params['breadcrumbs'][] = $this->title;
$url = Url::to(['categorias/buscar-ajax']);
$js = <<<EOT
    $('.btn-primary').click(function (ev) {
        ev.preventDefault();
        var data = $('#w0').serialize();
        $.ajax({
            url: '$url',
            data: data,
            success: function (data) {
                $('#rejilla').html(data);
            },
            error: function (a, b, c) {
                alert('Error');
            }
        });
    });
EOT;
$this->registerJs($js);
?>
<div class="categorias-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="categorias-search">

        <?php $form = ActiveForm::begin([
            'action' => ['buscar-ajax'],
            'method' => 'get',
        ]); ?>

            <?= $form->field($searchModel, 'id') ?>
            <?= $form->field($searchModel, 'categoria') ?>

            <div class="form-group">
                <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
                <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
            </div>

        <?php ActiveForm::end(); ?>
    </div>

    <p>
        <?= Html::a('Create Categorias', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div id="rejilla">
        <?= $this->render('_rejilla', [
            'dataProvider' => $dataProvider,
        ]) ?>
    </div>
</div>
