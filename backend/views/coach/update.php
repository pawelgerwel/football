<?php

use yii\helpers\Html;

$label = $model['first_name'] . ' ' . $model['last_name'];

$this->title = Yii::t('backend', 'Update {modelClass}: ', ['modelClass' => 'Coach']) . ' ' . $label;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Coaches'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $label, 'url' => ['view', 'id' => $model['id']]];
$this->params['breadcrumbs'][] = ['label'=>Yii::t('backend', 'Update')];
?>

<div class="coach-update">
    <p>
        <?= Html::a(Yii::t('backend', 'Back to list'), ['index'], ['class' => 'btn btn-warning']) ?>
    </p>
    <?= $this->render('_form', ['model' => $model]) ?>
</div>
