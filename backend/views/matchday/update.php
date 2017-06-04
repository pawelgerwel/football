<?php

use yii\helpers\Html;

$this->title = Yii::t('backend', 'Update {modelClass}: ', ['modelClass' => 'Matchday']) . ' ' . $model['name'];
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Matchdays'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model['name'], 'url' => ['view', 'id' => $model['id']]];
$this->params['breadcrumbs'][] = ['label'=>Yii::t('backend', 'Update')];
?>

<div class="matchday-update">
    <p>
        <?= Html::a(Yii::t('backend', 'Back to list'), ['index'], ['class' => 'btn btn-warning']) ?>
    </p>
    <?= $this->render('_form', ['model' => $model]) ?>
</div>
