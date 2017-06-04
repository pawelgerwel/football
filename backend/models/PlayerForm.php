<?php

namespace backend\models;

use yii\helpers\ArrayHelper;
use Yii;

class PlayerForm extends \backend\components\RecordForm {

    public $first_name;
    public $last_name;
    public $country_id;
    public $team_id;
    public $position;
    public $shirt_number;

    public function rules() {
        return [
            [['first_name', 'last_name', 'country_id', 'team_id', 'position',
                'shirt_number'], 'required'],
            [['first_name', 'last_name'], 'string', 'max' => 50],
            [['country_id', 'team_id'], 'integer'],
            ['position', 'in', 'range' => Yii::$app->dictionary->getPositions()],
            ['shirt_number', 'integer', 'min' => 0, 'max' => 99],
        ];
    }

    public function setModel($model) {
        parent::setModel($model);
        $this->first_name = ArrayHelper::getValue($model, 'first_name');
        $this->last_name = ArrayHelper::getValue($model, 'last_name');
        $this->country_id = ArrayHelper::getValue($model, 'country_id');
        $this->team_id = ArrayHelper::getValue($model, 'team_id');
        $this->position = ArrayHelper::getValue($model, 'position');
        $this->shirt_number = ArrayHelper::getValue($model, 'shirt_number');
    }

    public function save() {
        return $this->saveValues([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'country_id' => $this->country_id,
            'team_id' => $this->team_id,
            'position' => $this->position,
            'shirt_number' => $this->shirt_number
        ]);
    }

}
