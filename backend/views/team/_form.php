<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>

<div class="team-form">
    <?php $form = ActiveForm::begin() ?>
        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'city') ?>
        <?= $form->field($model, 'stadium') ?>
        <div class="form-group">
            <?= Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end() ?>
</div>
