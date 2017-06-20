<?php

use yii\helpers\Html;

$this->title = Yii::t('backend', 'Update {modelClass}: ', ['modelClass' => 'Goal']) . ' ' . $record['match_player_desc'];
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Goals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title];
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
