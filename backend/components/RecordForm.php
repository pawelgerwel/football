<?php

namespace backend\components;

use yii\helpers\ArrayHelper;
use Yii;

class RecordForm extends \yii\base\Model {

    const ROLE_CREATE = 0;
    const ROLE_UPDATE = 1;

    private $role;
    public $table;
    public $id;

    public function setRole($role) {
        $this->role = $role;
    }

    public function setModel($model) {
        $this->id = ArrayHelper::getValue($model, 'id');
    }

    public function saveValues($values) {
        if ($this->validate()) {
            $result = Yii::$app->dbHelper->insert($this->table, $values);
            return $result === 1;
        }
        return false;
    }

    public function updateValues($values) {
        if ($this->validate()) {
            $result = Yii::$app->dbHelper->updateOne($this->table, $this->id, $values);
            return true;
        }
        return false;
    }

    public function getId() {
        return $this->role === self::ROLE_CREATE
                ? Yii::$app->dbHelper->getLastInsertedId($this->table)
                : $this->id;
    }

}
