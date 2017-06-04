<?php

$this->title = Yii::t('backend', 'Update {modelClass}: ', ['modelClass' => 'Country']) . ' ' . $model['name'];
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Countries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model['name'], 'url' => ['view', 'id' => $model['id']]];
$this->params['breadcrumbs'][] = ['label'=>Yii::t('backend', 'Update')];
?>

<div class="country-update">
    <?= $this->render('_form', ['model' => $model]) ?>
</div>
