<?php

use yii\helpers\Html;

$label = $record['match_desc'] . ', ' . $record['out_player_desc'] . ' -> '
        . $record['in_player_desc'];

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
