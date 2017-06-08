<?php

use yii\helpers\Html;

$matchPlaer = Yii::$app->dbHelper->getOne('match_player', $model['match_player_id']);
$match = Yii::$app->dbHelper->getOne('match', $matchPlaer['match_id']);
$matchday = Yii::$app->dbHelper->getOne('matchday', $match['matchday_id']);
$homeTeam = Yii::$app->dbHelper->getOne('team', $match['home_team_id']);
$awayTeam = Yii::$app->dbHelper->getOne('team', $match['guest_team_id']);
$player = Yii::$app->dbHelper->getOne('player', $matchPlaer['player_id']);
$matchDescription = $matchday['name'] . ': ' . $homeTeam['name'] . ' - '
                . $awayTeam['name'];
$playerFullName = $player['first_name'] . ' ' . $player['last_name'];

$label = $matchDescription . ', ' . $playerFullName;

$this->title = Yii::t('backend', 'Update {modelClass}: ', ['modelClass' => 'Goal']) . ' ' . $label;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Goals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label'=> $this->title];
?>

<div class="match-player-update">
    <p>
        <?= Html::a(Yii::t('backend', 'Back to list'), ['index'], ['class' => 'btn btn-warning']) ?>
    </p>
    <?= $this->render('_form', [
        'model' => $model,
        'players' => $players
    ]) ?>
</div>
