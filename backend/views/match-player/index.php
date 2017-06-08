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
                'value' => function($model) {
                        $match = Yii::$app->dbHelper->getOne('match', $model['match_id']);
                        $matchday = Yii::$app->dbHelper->getOne('matchday', $match['matchday_id']);
                        $homeTeam = Yii::$app->dbHelper->getOne('team', $match['home_team_id']);
                        $awayTeam = Yii::$app->dbHelper->getOne('team', $match['guest_team_id']);
                        return 'Matchday ' . $matchday['name'] . ': '
                                . $homeTeam['name'] . ' - ' . $awayTeam['name'];
                    }
            ],
            [
                'header' => 'Player',
                'value' => function($model) {
                        $player = Yii::$app->dbHelper->getOne('player', $model['player_id']);
                        return $player['first_name'] . ' ' . $player['last_name'];
                    }
            ],
            'is_base:boolean',
        ],
    ]) ?>
</div>
