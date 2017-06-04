<?php

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Country',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Countries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="country-create">
    <?= $this->render('_form', ['model' => $model]) ?>
</div>
