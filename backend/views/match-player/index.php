<?php

use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$this->title = 'Match Players';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="match-player-index">
    <p>
        <?= Html::a(Yii::t('backend', 'Create {modelClass}', [
                'modelClass' => 'Match Player',
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
            ['class' => 'yii\grid\ActionColumn'],
            'id',
            [
                'header' => 'Match',
                'attribute' => 'match_desc'
            ],
            [
                'header' => 'Player',
                'attribute' => 'player_desc'
            ],
            'is_base:boolean',
        ],
    ]) ?>
</div>
