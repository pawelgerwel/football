<?php

namespace common\components;

use Yii;

class DbHelper extends \yii\base\Component {

    public function getAll($table) {
        return Yii::$app->db2->createCommand("select * from $table")
                        ->queryAll();
    }

    public function getOne($table, $id) {
        return Yii::$app->db2->createCommand("select * from $table where id = $id")
                        ->queryOne();
    }

    public function insert($table, $values) {
        return Yii::$app->db2->createCommand()
                        ->insert($table, $values)
                        ->execute();
    }

    public function updateOne($table, $id, $values) {
        return Yii::$app->db2->createCommand()
                        ->update($table, $values, ['id' => $id])
                        ->execute();
    }

    public function deleteOne($table, $id) {
        return Yii::$app->db2->createCommand()
                        ->delete($table, ['id' => $id])
                        ->execute();
    }

    public function getLastInsertedId($table) {
        return Yii::$app->db2->createCommand("select max(id) from $table")
                        ->queryScalar();
    }

}
