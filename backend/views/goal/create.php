<?php

use yii\helpers\Html;

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Match Player',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Match Players'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="match-player-create">
    <p>
        <?= Html::a(Yii::t('backend', 'Back to list'), ['index'], ['class' => 'btn btn-warning']) ?>
    </p>
    <?= $this->render('_form', [
        'model' => $model,
        'players' => $players
    ]) ?>
</div>
