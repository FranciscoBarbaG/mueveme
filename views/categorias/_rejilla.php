<?php
use yii\grid\GridView;
?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'categoria',
        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>
