<?php

namespace backend\models;

use yii\helpers\ArrayHelper;

class MatchForm extends \backend\components\RecordForm {

    public $matchday_id;
    public $home_team_id;
    public $guest_team_id;
    public $start_time;

    public function rules() {
        return [
            [['matchday_id', 'home_team_id', 'guest_team_id', 'start_time'],
                'required'],
            [['matchday_id', 'home_team_id', 'guest_team_id'], 'integer'],
            ['start_time', 'safe'],
            ['guest_team_id', 'compare', 'compareAttribute' => 'home_team_id',
                'operator' => '!=='],
        ];
    }

    public function setModel($model) {
        parent::setModel($model);
        $this->matchday_id = ArrayHelper::getValue($model, 'matchday_id');
        $this->home_team_id = ArrayHelper::getValue($model, 'home_team_id');
        $this->guest_team_id = ArrayHelper::getValue($model, 'guest_team_id');
        $this->start_time = ArrayHelper::getValue($model, 'start_time');
    }

    public function save() {
        return $this->saveValues([
            'matchday_id' => $this->matchday_id,
            'home_team_id' => $this->home_team_id,
            'guest_team_id' => $this->guest_team_id,
            'start_time' => $this->start_time
        ]);
    }

}
