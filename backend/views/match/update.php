<?php

use yii\helpers\Html;

$label = $record['matchday_desc'] . ': ' . $record['home_team_desc']
        . ' - ' . $record['guest_team_desc'];

$this->title = Yii::t('backend', 'Update {modelClass}: ', ['modelClass' => 'Match']) . ' ' . $label;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Matches'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $label, 'url' => ['view', 'id' => $model['id']]];
$this->params['breadcrumbs'][] = ['label'=>Yii::t('backend', 'Update')];
?>

<div class="match-update">
    <p>
        <?= Html::a(Yii::t('backend', 'Back to list'), ['index'], ['class' => 'btn btn-warning']) ?>
    </p>
    <?= $this->render('_form', ['model' => $model]) ?>
</div>
