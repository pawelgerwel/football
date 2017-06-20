<?php

use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$this->title = 'Matches';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="match-index">
    <p>
        <?= Html::a(Yii::t('backend', 'Create {modelClass}', [
                'modelClass' => 'Match',
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
                'header' => 'Matchday',
                'attribute' => 'matchday_desc'
            ],
            [
                'header' => 'Home Team',
                'attribute' => 'home_team_desc'
            ],
            [
                'header' => 'Away Team',
                'attribute' => 'guest_team_desc'
            ],
        ],
    ]) ?>
</div>
