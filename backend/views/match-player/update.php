<?php

use yii\helpers\Html;

$match = Yii::$app->dbHelper->getOne('match', $model['match_id']);
$matchday = Yii::$app->dbHelper->getOne('matchday', $match['matchday_id']);
$homeTeam = Yii::$app->dbHelper->getOne('team', $match['home_team_id']);
$awayTeam = Yii::$app->dbHelper->getOne('team', $match['guest_team_id']);
$player = Yii::$app->dbHelper->getOne('player', $model['player_id']);
$matchDescription = $matchday['name'] . ': ' . $homeTeam['name'] . ' - '
                . $awayTeam['name'];
$playerFullName = $player['first_name'] . ' ' . $player['last_name'];

$label = $matchDescription . ', ' . $playerFullName;

$this->title = Yii::t('backend', 'Update {modelClass}: ', ['modelClass' => 'Match Player']) . ' ' . $label;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Match Players'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $label, 'url' => ['view', 'id' => $model['id']]];
$this->params['breadcrumbs'][] = ['label'=>Yii::t('backend', 'Update')];
?>

<div class="match-player-update">
    <p>
        <?= Html::a(Yii::t('backend', 'Back to list'), ['index'], ['class' => 'btn btn-warning']) ?>
    </p>
    <?= $this->render('_form', [
        'model' => $model,
        'matches' => $matches,
        'players' => $players
    ]) ?>
</div>
