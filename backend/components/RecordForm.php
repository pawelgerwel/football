<?php

namespace backend\components;

use yii\helpers\ArrayHelper;
use Yii;

class RecordForm extends \yii\base\Model {

    const ROLE_CREATE = 0;
    const ROLE_UPDATE = 1;

    private $_table;
    private $_role;

    public $id;

    public function __construct($table, $role) {
        $this->_table = $table;
        $this->_role = $role;
    }

    public function setModel($model) {
        $this->id = ArrayHelper::getValue($model, 'id');
    }

    public function saveValues($values) {
        if ($this->validate()) {
            if ($this->_role === self::ROLE_CREATE) {
                $result = Yii::$app->dbHelper->insert($this->_table, $values);
                return true;
            } else {
                $result = Yii::$app->dbHelper->updateOne($this->_table, $this->id, $values);
                return true;
            }
        }
        return false;
    }

    public function getId() {
        return $this->_role === self::ROLE_CREATE
                ? Yii::$app->dbHelper->getLastInsertedId($this->_table)
                : $this->id;
    }

}
