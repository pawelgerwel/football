<?php

namespace backend\models;

use yii\helpers\ArrayHelper;

class TeamForm extends \backend\components\RecordForm {

    public $name;
    public $city;
    public $stadium;

    public function rules() {
        return [
            [['name', 'city', 'stadium'], 'required'],
            [['name', 'city'], 'string', 'max' => 50],
            ['stadium', 'string', 'max' => 100],
        ];
    }

    public function setModel($model) {
        parent::setModel($model);
        $this->name = ArrayHelper::getValue($model, 'name');
        $this->city = ArrayHelper::getValue($model, 'city');
        $this->stadium = ArrayHelper::getValue($model, 'stadium');
    }

    public function save() {
        return $this->saveValues([
            'name' => $this->name,
            'city' => $this->city,
            'stadium' => $this->stadium
        ]);
    }

}
