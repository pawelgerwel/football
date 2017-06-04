<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
?>

<div class="coach-form">
    <?php $form = ActiveForm::begin() ?>
        <?= $form->field($model, 'first_name') ?>
        <?= $form->field($model, 'last_name') ?>
        <?= $form->field($model, 'country_id')
            ->dropDownList(ArrayHelper::map(Yii::$app->dbHelper->getAll('country'), 'id', 'name'), ['prompt' => ''])
            ->label('Country') ?>
        <?= $form->field($model, 'team_id')
            ->dropDownList(ArrayHelper::map(Yii::$app->dbHelper->getAll('team'), 'id', 'name'), ['prompt' => ''])
            ->label('Team') ?>
        <?= $form->field($model, 'type')->radioList(Yii::$app->dictionary->getCoachTypeLabels()) ?>
        <div class="form-group">
            <?= Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end() ?>
</div>
