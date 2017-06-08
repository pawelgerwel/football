<?php

namespace backend\models;

use yii\helpers\ArrayHelper;
use Yii;

class SubstituteForm extends \backend\components\RecordForm {

    public $in_match_player_id;
    public $out_match_player_id;
    public $minute;

    public function rules() {
        return [
            [['in_match_player_id', 'out_match_player_id', 'minute'], 'required'],
            [['in_match_player_id', 'out_match_player_id'], 'integer'],
            ['minute', 'string', 'max' => 10],
        ];
    }

    public function setModel($model) {
        parent::setModel($model);
        $this->in_match_player_id = ArrayHelper::getValue($model, 'in_match_player_id');
        $this->out_match_player_id = ArrayHelper::getValue($model, 'out_match_player_id');
        $this->minute = ArrayHelper::getValue($model, 'minute');
    }

    public function save() {
        return $this->saveValues([
            'in_match_player_id' => $this->in_match_player_id,
            'out_match_player_id' => $this->out_match_player_id,
            'minute' => $this->minute,
        ]);
    }

}
