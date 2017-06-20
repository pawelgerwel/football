<?php

namespace common\components;

use Yii;

class DbHelper extends \yii\base\Component {

    public function getAll($table) {
        $result = Yii::$app->db2->createCommand("select * from $table")
                        ->queryAll();
        return $this->normalizeKeys($result);
    }

    public function getOne($table, $id) {
        $result = Yii::$app->db2->createCommand("select * from $table where id = $id")
                        ->queryOne();
        return $this->normalizeKeys($result);
    }

    public function normalizeKeys($array) {
        if (!empty($array)) {
            foreach ($array as $key => $value) {
                $array[$key] = is_array($value) ? $this->normalizeKeys($value) : $value;
            }
        }
        return array_change_key_case($array);
    }

    public function insert($table, $values) {
        $fields = [];
        if (!empty($values)) {
            foreach ($values as $field => $value) {
                $fields[] = $field;
                $values[$field] = is_string($value) ? "'$value'" : $value;
            }
        }
        $fieldString = implode(',', $fields);
        $valueString = implode(',', $values);
        return Yii::$app->db2->createCommand("call crud.insert_$table($valueString)")
                        ->execute();
    }

    public function updateOne($table, $id, $values) {
        $assignings = [];
        if (!empty($values)) {
            foreach ($values as $field => $value) {
                $assignings[] = "$field = " . (is_string($value) ? "'$value'" : $value);
            }
        }
        $assigningString = implode(',', $assignings);
        return Yii::$app->db2->createCommand("update $table set $assigningString where id = $id")
                        ->execute();
    }

    public function deleteOne($table, $id) {
        return Yii::$app->db2->createCommand("delete from $table where id = $id")
                        ->execute();
    }

    public function getLastInsertedId($table) {
        return Yii::$app->db2->createCommand("select max(id) from $table")
                        ->queryScalar();
    }

    public function getAllMatching($table, $conditions) {
        $whereParts = [];
        if (!empty($conditions)) {
            foreach ($conditions as $field => $value) {
                $whereParts[] = $field . ' like "%' . $value . '%"';
            }
        }
        $where = implode(' AND ', $whereParts);
        return Yii::$app->db2->createCommand("select * from $table"
                            . (empty($where) ? '' : "where $where"))
                        ->queryAll();
    }

    public function getPlayersOfTeams($teamIds) {
        return Yii::$app->db2->createCommand("select * from player where team_id in (" . implode(',', $teamIds) . ")")
            ->queryAll();

    }
    
//    public function getCountryName($id) {
//        return Yii::$app->db2->createCommand("p_country.get_name($id)")
//                ->queryScalar();
//    }
//
//    public function getMatch($id) {
//        return Yii::$app->db2->createCommand("select p_match.get_desc(id) as description from match where id = $id")
//                ->queryOne();
//    }
//    
//    public function getMatchPlayer($id) {
//        return Yii::$app->db2->createCommand("select p_match_player.get_desc(id) as description from match_player where id = $id")
//                ->queryOne();
//    }
//    
//    public function getCoach($id) {
//        return Yii::$app->db2->createCommand("select p_country.get_name(country_id) as country_name from coach where id = $id")
//                ->queryOne();
//    }
    
}
