<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuariosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
$url = Url::to(['usuarios/banear-ajax']);
$js = <<<EOT
    $('.baneo').click(function (event) {
        event.preventDefault();
        var el = $(this);
        var res = window.confirm('¿Seguro que desea banear a ese usuario?');
        var id = el.parents('tr').data('key');
        if (res) {
            $.ajax({
                url: '$url',
                method: 'POST',
                data: { id: id },
                success: function (data) {
                    el.parent().siblings('.valorbaneo').html(data);
                }
            });
        }
    });
EOT;
$this->registerJs($js);
?>
<div class="usuarios-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Usuarios', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'nombre',
            'email:email',
            'created_at:datetime',
            [
                'attribute' => 'baneado',
                'format' => 'boolean',
                'contentOptions' => ['class' => 'valorbaneo'],
            ],
            // 'baneado:boolean',
            //'token',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {ban}',
                'buttons' => [
                    'ban' => function ($url, $model, $key) {
                        return Html::a(
                            'Banear',
                            ['usuarios/banear', 'id' => $model->id],
                            [
                                'class' => 'baneo',
                                // 'data-method' => 'POST',
                                // 'data-confirm' => '¿Seguro que desea banear a ese usuario?'
                            ]);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
