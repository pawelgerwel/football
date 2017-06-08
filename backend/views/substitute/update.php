<?php

use yii\helpers\Html;

$inMatchPlaer = Yii::$app->dbHelper->getOne('match_player', $model['in_match_player_id']);
$outMatchPlaer = Yii::$app->dbHelper->getOne('match_player', $model['out_match_player_id']);
$match = Yii::$app->dbHelper->getOne('match', $inMatchPlaer['match_id']);
$matchday = Yii::$app->dbHelper->getOne('matchday', $match['matchday_id']);
$homeTeam = Yii::$app->dbHelper->getOne('team', $match['home_team_id']);
$awayTeam = Yii::$app->dbHelper->getOne('team', $match['guest_team_id']);
$inPlayer = Yii::$app->dbHelper->getOne('player', $inMatchPlaer['player_id']);
$outPlayer = Yii::$app->dbHelper->getOne('player', $outMatchPlaer['player_id']);
$matchDescription = $matchday['name'] . ': ' . $homeTeam['name'] . ' - '
                . $awayTeam['name'];
$playerFullName = $outPlayer['last_name'] . ' -> ' . $inPlayer['last_name'];

$label = $matchDescription . ', ' . $playerFullName;

$this->title = Yii::t('backend', 'Update {modelClass}: ', ['modelClass' => 'Substitute']) . ' ' . $label;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Substitutes'), 'url' => ['index']];
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
