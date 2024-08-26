<?php use yii\grid\ActionColumn;

/** @var yii\web\View $this */
/** @var \yii\data\ActiveDataProvider $imagesProvider */
/** @var string $token */

$this->title = 'Админка';
?>
<div class="site-index">

    <div class="body-content">

        <?php
        echo \yii\grid\GridView::widget(
            [
                'dataProvider' => $imagesProvider,
                'tableOptions' => [
                    'class' => 'table',
                    'id' => 'bootstrap-table',
                    //'style' => 'margin: 0 15px;',
                ],
                'columns' => [
                    [
                        'format' =>  'html',
                        'label' => 'ID',
                        'value' => static function ($model) {
                            $url = \app\services\PicsumService::PICSUM_URL .  $model->picsum_id . '/600/500';
                            return \yii\helpers\Html::a($model->picsum_id, $url, ['target' => '_blank']);
                        },
                    ],
                    [
                        'format' =>  'html',
                        'label' => 'Решение',
                        'value' => static function ($model) {
                            return $model->approved ? 'Одобрено' : 'Отклонено';
                        },
                    ],
                    [
                        'class' => ActionColumn::class,
                        'template' => '{remove}',
                        'buttons' => [
                            'remove' => static function ($model, $column) {
                                return \yii\helpers\Html::button('Отменить решение', ['rel' => 'tooltip',
                                    'class' => 'btn btn-simple btn-danger btn-icon table-action remove delete-decision-btn',
                                    'data-original-title' => 'Удалить', 'data-id' => $column['id']]);
                            },
                        ],
                    ],
                ],
                'showFooter' => 'true',
                'summary' => '',
            ]
        );
        ?>

    </div>
</div>
