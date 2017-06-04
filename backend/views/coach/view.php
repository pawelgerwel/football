<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model['first_name'] . ' ' . $model['last_name'];
$this->params['breadcrumbs'][] = ['label' => 'Coaches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="coach-view">
    <p>
        <?= Html::a(Yii::t('backend', 'Back to list'), ['index'], ['class' => 'btn btn-warning']) ?>
        <?= Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model['id']], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model['id']], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'first_name',
            'last_name',
            [
                'label' => 'Country',
                'value' => Yii::$app->dbHelper->getOne('country', $model['country_id'])['name']
            ],
            [
                'label' => 'Team',
                'value' => Yii::$app->dbHelper->getOne('team', $model['team_id'])['name']
            ],
            [
                'label' => 'Type',
                'value' => Yii::$app->dictionary->getCoachTypeLabels($model['type'])
            ],
        ],
    ]) ?>
</div>
