<?php

namespace common\components;

use Yii;

class DbHelper extends \yii\base\Component {

    public function getAll($table) {
        $additionString = implode(', ', $this->getAdditionalData($table));
        $result = Yii::$app->db2->createCommand("select $table.*" . (empty($additionString) ? '' : ", $additionString") . " from $table order by id asc")
                        ->queryAll();
        return $this->normalizeKeys($result);
    }

    public function getOne($table, $id) {
        $additionString = implode(', ', $this->getAdditionalData($table));
        $result = Yii::$app->db2->createCommand("select $table.*" . (empty($additionString) ? '' : ", $additionString") . " from $table where id = $id")
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

    private function getAdditionalData($table) {
        $result = [];
        switch ($table) {
            case 'player': case 'coach':
                $result = [
                    'description.get_country(country_id) as country_desc',
                    'description.get_team(team_id) as team_desc'
                ];
                break;
            case 'match':
                $result = [
                    'description.get_team(home_team_id) as home_team_desc',
                    'description.get_team(guest_team_id) as guest_team_desc',
                    'description.get_matchday(matchday_id) as matchday_desc',
                ];
                break;
            case 'match_player':
                $result = [
                    'description.get_match(match_id) as match_desc',
                    'description.get_player(player_id) as player_desc',
                ];
                break;
            case 'goal': case 'card':
                $result = [
                    'description.get_match_player(match_player_id) as match_player_desc',
                ];
                break;
            case 'substitute':
                $result = [
                    'description.get_match_player(in_match_player_id) as in_match_player_desc',
                    'description.get_match_player(out_match_player_id) as out_match_player_desc',
                    'description.get_player(p_match_player.get_player_id(in_match_player_id)) as in_player_desc',
                    'description.get_player(p_match_player.get_player_id(out_match_player_id)) as out_player_desc',
                    'description.get_match(p_match_player.get_match_id(out_match_player_id)) as match_desc',
                ];
                break;
        }
        return $result;
    }

}
