<?php

use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$this->title = 'Goals';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="match-player-index">
    <p>
        <?= Html::a(Yii::t('backend', 'Create {modelClass}', [
                'modelClass' => 'Goal',
            ]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => new ArrayDataProvider([
            'id' => 'id',
            'allModels' => ArrayHelper::index($models, 'id')
        ]),
        'options' => [
            'class' => 'grid-view table-responsive'
        ],
        'columns' => [
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}'
            ],
            'id',
            [
                'header' => 'Match Player',
                'attribute' => 'match_player_desc'
            ],
            'is_penalty:boolean',
            'is_own:boolean',
            'minute',
        ],
    ]) ?>
</div>
