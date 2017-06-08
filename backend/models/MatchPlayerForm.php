<?php

namespace backend\models;

use yii\helpers\ArrayHelper;
use Yii;

class MatchPlayerForm extends \backend\components\RecordForm {

    public $match_id;
    public $player_id;
    public $is_base;

    public function rules() {
        return [
            [['match_id', 'player_id', 'is_base'], 'required'],
            [['match_id', 'player_id'], 'integer'],
            ['is_base', 'boolean'],
        ];
    }

    public function setModel($model) {
        parent::setModel($model);
        $this->match_id = ArrayHelper::getValue($model, 'match_id');
        $this->player_id = ArrayHelper::getValue($model, 'player_id');
        $this->is_base = ArrayHelper::getValue($model, 'is_base');
    }

    public function save() {
        return $this->saveValues([
            'match_id' => $this->match_id,
            'player_id' => $this->player_id,
            'is_base' => $this->is_base,
        ]);
    }

}
