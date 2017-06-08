<?php

use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$this->title = 'Substitutes';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="match-player-index">
    <p>
        <?= Html::a(Yii::t('backend', 'Create {modelClass}', [
                'modelClass' => 'Substitute',
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
                'header' => 'Match Player Out',
                'value' => function($model) {
                        $matchPlaer = Yii::$app->dbHelper->getOne('match_player', $model['out_match_player_id']);
                        $player = Yii::$app->dbHelper->getOne('player', $matchPlaer['player_id']);
                        $match = Yii::$app->dbHelper->getOne('match', $matchPlaer['match_id']);
                        $matchday = Yii::$app->dbHelper->getOne('matchday', $match['matchday_id']);
                        $homeTeam = Yii::$app->dbHelper->getOne('team', $match['home_team_id']);
                        $awayTeam = Yii::$app->dbHelper->getOne('team', $match['guest_team_id']);
                        return $matchday['name'] . ': '
                                . $homeTeam['name'] . ' - ' . $awayTeam['name']
                                . ' ' . $player['first_name'] . ' ' . $player['last_name'];
                    }
            ],
            [
                'header' => 'Match Player In',
                'value' => function($model) {
                        $matchPlaer = Yii::$app->dbHelper->getOne('match_player', $model['in_match_player_id']);
                        $player = Yii::$app->dbHelper->getOne('player', $matchPlaer['player_id']);
                        $match = Yii::$app->dbHelper->getOne('match', $matchPlaer['match_id']);
                        $matchday = Yii::$app->dbHelper->getOne('matchday', $match['matchday_id']);
                        $homeTeam = Yii::$app->dbHelper->getOne('team', $match['home_team_id']);
                        $awayTeam = Yii::$app->dbHelper->getOne('team', $match['guest_team_id']);
                        return $matchday['name'] . ': '
                                . $homeTeam['name'] . ' - ' . $awayTeam['name']
                                . ' ' . $player['first_name'] . ' ' . $player['last_name'];
                    }
            ],
            'minute',
        ],
    ]) ?>
</div>
