<?php

namespace backend\models;

use yii\helpers\ArrayHelper;
use Yii;

class GoalForm extends \backend\components\RecordForm {

    public $match_player_id;
    public $is_own;
    public $is_penalty;
    public $minute;

    public function rules() {
        return [
            [['match_player_id', 'is_own', 'is_penalty', 'minute'], 'required'],
            [['match_player_id'], 'integer'],
            [['is_own', 'is_penalty'], 'boolean'],
            ['minute', 'string', 'max' => 10],
        ];
    }

    public function setModel($model) {
        parent::setModel($model);
        $this->match_player_id = ArrayHelper::getValue($model, 'match_player_id');
        $this->is_own = ArrayHelper::getValue($model, 'is_own');
        $this->is_penalty = ArrayHelper::getValue($model, 'is_penalty');
        $this->minute = ArrayHelper::getValue($model, 'minute');
    }

    public function save() {
        return $this->saveValues([
            'match_player_id' => $this->match_player_id,
            'is_own' => $this->is_own,
            'is_penalty' => $this->is_penalty,
            'minute' => $this->minute,
        ]);
    }

}
