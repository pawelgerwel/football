<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model['match_desc'] . ', ' . $model['player_desc'];
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
                'value' => $model['match_desc']
            ],
            [
                'label' => 'Player',
                'value' => $model['player_desc']
            ],
            'is_base:boolean'
        ],
    ]) ?>
</div>
