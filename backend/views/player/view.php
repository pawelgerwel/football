<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model['first_name'] . ' ' . $model['last_name'];
$this->params['breadcrumbs'][] = ['label' => 'Players', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="player-view">
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
            'first_name',
            'last_name',
            [
                'label' => 'Country',
                'value' => $model['country_desc']
            ],
            [
                'label' => 'Team',
                'value' => $model['team_desc']
            ],
            [
                'label' => 'Position',
                'value' => Yii::$app->dictionary->getPositionLabels($model['position'])
            ],
            'shirt_number',
        ],
    ]) ?>
</div>
