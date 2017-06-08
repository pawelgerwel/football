<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
?>

<div class="match-player-form">
    <?php $form = ActiveForm::begin() ?>
        <?= $form->field($model, 'out_match_player_id')
            ->dropDownList(ArrayHelper::map($players, 'id', 'name'), ['prompt' => ''])
            ->label('Match Player Out') ?>
        <?= $form->field($model, 'in_match_player_id')
            ->dropDownList(ArrayHelper::map($players, 'id', 'name'), ['prompt' => ''])
            ->label('Match Player In') ?>
        <?= $form->field($model, 'minute') ?>
        <div class="form-group">
            <?= Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end() ?>
</div>
