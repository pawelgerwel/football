<?php

use kartik\datetime\DateTimePicker;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
?>

<div class="match-form">
    <?php $form = ActiveForm::begin() ?>
        <?= $form->field($model, 'matchday_id')
            ->dropDownList(ArrayHelper::map(Yii::$app->dbHelper->getAll('matchday'), 'id', 'name'), ['prompt' => ''])
            ->label('Matchday') ?>
        <?= $form->field($model, 'home_team_id')
            ->dropDownList(ArrayHelper::map(Yii::$app->dbHelper->getAll('team'), 'id', 'name'), ['prompt' => ''])
            ->label('Home Team') ?>
        <?= $form->field($model, 'guest_team_id')
            ->dropDownList(ArrayHelper::map(Yii::$app->dbHelper->getAll('team'), 'id', 'name'), ['prompt' => ''])
            ->label('Away Team') ?>
        <?= $form->field($model, 'start_time')->widget(DateTimePicker::classname(), [
                'options' => ['placeholder' => 'Enter start time'],
                'pluginOptions' => [
                    'autoclose' => true
                ]
            ]) ?>
        <div class="form-group">
            <?= Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end() ?>
</div>
