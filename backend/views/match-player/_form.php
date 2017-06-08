<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
?>

<div class="match-player-form">
    <?php $form = ActiveForm::begin() ?>
        <?= $form->field($model, 'match_id')
            ->dropDownList(ArrayHelper::map($matches, 'id', 'name'), ['prompt' => ''])
            ->label('Match') ?>
        <?= $form->field($model, 'player_id')
            ->dropDownList(ArrayHelper::map($players, 'id', 'name'), ['prompt' => ''])
            ->label('Player') ?>
        <?= $form->field($model, 'is_base')->checkbox() ?>
        <div class="form-group">
            <?= Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end() ?>
</div>
