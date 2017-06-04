<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = Yii::$app->dbHelper->getOne('matchday', $model['matchday_id'])['name']
        . ': ' . Yii::$app->dbHelper->getOne('team', $model['home_team_id'])['name']
        . ' - ' . Yii::$app->dbHelper->getOne('team', $model['guest_team_id'])['name'];
$this->params['breadcrumbs'][] = ['label' => 'Matches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="match-view">
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
                'label' => 'Matchday',
                'value' => Yii::$app->dbHelper->getOne('matchday', $model['matchday_id'])['name']
            ],
            [
                'label' => 'Home Team',
                'value' => Yii::$app->dbHelper->getOne('team', $model['home_team_id'])['name']
            ],
            [
                'label' => 'Away Team',
                'value' => Yii::$app->dbHelper->getOne('team', $model['guest_team_id'])['name']
            ],
            'start_time:datetime'
        ],
    ]) ?>
</div>
