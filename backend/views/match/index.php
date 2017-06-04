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
                'value' => function($model) { return Yii::$app->dbHelper->getOne('matchday', $model['matchday_id'])['name']; }
            ],
            [
                'header' => 'Home Team',
                'value' => function($model) { return Yii::$app->dbHelper->getOne('team', $model['home_team_id'])['name']; }
            ],
            [
                'header' => 'Away Team',
                'value' => function($model) { return Yii::$app->dbHelper->getOne('team', $model['guest_team_id'])['name']; }
            ],
        ],
    ]) ?>
</div>
