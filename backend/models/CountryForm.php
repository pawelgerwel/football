<?php

namespace backend\models;

use yii\helpers\ArrayHelper;

class CountryForm extends \backend\components\RecordForm {

    public $name;

    public function rules() {
        return [
            ['name', 'required'],
            ['name', 'string', 'max' => 50],
        ];
    }

    public function setModel($model) {
        parent::setModel($model);
        $this->name = ArrayHelper::getValue($model, 'name');
    }

    public function save() {
        return $this->saveValues([
            'name' => $this->name
        ]);
    }

}
