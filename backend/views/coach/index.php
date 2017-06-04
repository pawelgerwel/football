<?php

use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$this->title = 'Coaches';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="coach-index">
    <p>
        <?= Html::a(Yii::t('backend', 'Create {modelClass}', [
                'modelClass' => 'Coach',
            ]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => new ArrayDataProvider([
            'id' => 'id',
            'allModels' => ArrayHelper::index($models, 'id')
        ]),
        'options' => [
            'class' => 'grid-view table-responsive'
        ],
        'columns' => [
            ['class' => 'yii\grid\ActionColumn'],
            'id',
            'first_name',
            'last_name',
        ],
    ]) ?>
</div>
