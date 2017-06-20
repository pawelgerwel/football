<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model['matchday_desc'] . ': ' . $model['home_team_desc']
        . ' - ' . $model['guest_team_desc'];
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
                'value' => $model['matchday_desc']
            ],
            [
                'label' => 'Home Team',
                'value' => $model['home_team_desc']
            ],
            [
                'label' => 'Away Team',
                'value' => $model['guest_team_desc']
            ],
            'start_time:datetime'
        ],
    ]) ?>
</div>
