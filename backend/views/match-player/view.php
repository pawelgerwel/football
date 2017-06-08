<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$match = Yii::$app->dbHelper->getOne('match', $model['match_id']);
$matchday = Yii::$app->dbHelper->getOne('matchday', $match['matchday_id']);
$homeTeam = Yii::$app->dbHelper->getOne('team', $match['home_team_id']);
$awayTeam = Yii::$app->dbHelper->getOne('team', $match['guest_team_id']);
$player = Yii::$app->dbHelper->getOne('player', $model['player_id']);
$matchDescription = $matchday['name'] . ': ' . $homeTeam['name'] . ' - '
                . $awayTeam['name'];
$playerFullName = $player['first_name'] . ' ' . $player['last_name'];

$this->title = $matchDescription . ', ' . $playerFullName;
$this->params['breadcrumbs'][] = ['label' => 'Match Players', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="match-player-view">
    <p>
        <?= Html::a(Yii::t('backend', 'Back to list'), ['index'], ['class' => 'btn btn-warning']) ?>
        <?= Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model['id']], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model['id']], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'label' => 'Match',
                'value' => $matchDescription
            ],
            [
                'label' => 'Player',
                'value' => $playerFullName
            ],
            'is_base:boolean'
        ],
    ]) ?>
</div>
