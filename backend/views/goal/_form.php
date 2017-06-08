<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
?>

<div class="match-player-form">
    <?php $form = ActiveForm::begin() ?>
        <?= $form->field($model, 'match_player_id')
            ->dropDownList(ArrayHelper::map($players, 'id', 'name'), ['prompt' => ''])
            ->label('Match Player') ?>
        <?= $form->field($model, 'is_penalty')->checkbox() ?>
        <?= $form->field($model, 'is_own')->checkbox() ?>
        <?= $form->field($model, 'minute') ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end() ?>
</div>
