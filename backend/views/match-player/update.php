<?php

use yii\helpers\Html;

$label = $record['match_desc'] . ', ' . $record['player_desc'];

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
