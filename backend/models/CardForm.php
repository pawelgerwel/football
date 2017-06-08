<?php

namespace backend\models;

use yii\helpers\ArrayHelper;
use Yii;

class CardForm extends \backend\components\RecordForm {

    const COLOR_YELLOW = 0;
    const COLOR_RED = 0;
    
    public $match_player_id;
    public $color;
    public $minute;

    public function rules() {
        return [
            [['match_player_id', 'color', 'minute'], 'required'],
            [['match_player_id'], 'integer'],
            [['color'], 'integer'],
            ['minute', 'string', 'max' => 10],
        ];
    }

    public function setModel($model) {
        parent::setModel($model);
        $this->match_player_id = ArrayHelper::getValue($model, 'match_player_id');
        $this->color = ArrayHelper::getValue($model, 'color');
        $this->minute = ArrayHelper::getValue($model, 'minute');
    }

    public function save() {
        return $this->saveValues([
            'match_player_id' => $this->match_player_id,
            'color' => $this->color,
            'minute' => $this->minute,
        ]);
    }

}
