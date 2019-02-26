<?php
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;
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
                    $('#rejilla').html(data);
                }
            });
        }
    });
EOT;
$this->registerJs($js);
?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        'nombre',
        'email:email',
        'created_at:datetime',
        'baneado:boolean',
        //'token',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {update} {delete} {ban}',
            'buttons' => [
                'ban' => function ($url, $model, $key) {
                    return Html::a(
                        'Banear',
                        ['usuarios/banear', 'id' => $model->id],
                        [ 'class' => 'baneo' ]);
                },
            ],
        ],
    ],
]); ?>
