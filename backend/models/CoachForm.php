<?php

namespace backend\models;

use yii\helpers\ArrayHelper;
use Yii;

class CoachForm extends \backend\components\RecordForm {

    public $first_name;
    public $last_name;
    public $country_id;
    public $team_id;
    public $type;

    public function rules() {
        return [
            [['first_name', 'last_name', 'country_id', 'team_id', 'type'],
                'required'],
            [['first_name', 'last_name'], 'string', 'max' => 50],
            [['country_id', 'team_id'], 'integer'],
            ['type', 'in', 'range' => Yii::$app->dictionary->getCoachTypes()],
        ];
    }

    public function setModel($model) {
        parent::setModel($model);
        $this->first_name = ArrayHelper::getValue($model, 'first_name');
        $this->last_name = ArrayHelper::getValue($model, 'last_name');
        $this->country_id = ArrayHelper::getValue($model, 'country_id');
        $this->team_id = ArrayHelper::getValue($model, 'team_id');
        $this->type = ArrayHelper::getValue($model, 'type');
    }

    public function save() {
        return $this->saveValues([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'country_id' => $this->country_id,
            'team_id' => $this->team_id,
            'type' => $this->type,
        ]);
    }

}
