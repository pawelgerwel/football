<?php

use yii\helpers\Html;

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Coach',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Coaches'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="coach-create">
    <p>
        <?= Html::a(Yii::t('backend', 'Back to list'), ['index'], ['class' => 'btn btn-warning']) ?>
    </p>
    <?= $this->render('_form', ['model' => $model]) ?>
</div>
