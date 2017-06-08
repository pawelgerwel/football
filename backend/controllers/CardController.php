<?php

namespace backend\controllers;

use yii\helpers\ArrayHelper;
use Yii;

class CardController extends \backend\components\CRUDController {

    public $table = 'card';
    public $modelClass = 'backend\models\CardForm';


    public function actionCreate() {
        $model = new $this->modelClass($this->table, self::ROLE_CREATE);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            $matchPlayers = Yii::$app->dbHelper->getAll('match_player');
            $matches = Yii::$app->dbHelper->getAll('match');
            $matchdays =  ArrayHelper::map(Yii::$app->dbHelper->getAll('matchday'), 'id', 'name');
            $teams = ArrayHelper::map(Yii::$app->dbHelper->getAll('team'), 'id', 'name');
            $players = Yii::$app->dbHelper->getAll('player');
            if (!empty($matches)) {
                foreach ($matches as $key => $match) {
                    $matches[$key]['name'] = $matchdays[$match['matchday_id']] . ': '
                            . $teams[$match['home_team_id']] . ' - ' . $teams[$match['guest_team_id']];
                }
            }
            if (!empty($players)) {
                foreach ($players as $key => $player) {
                    $players[$key]['name'] = $player['first_name'] . ' ' . $player['last_name']
                            . ' - ' . $teams[$player['team_id']];
                }
            }
            $matches = ArrayHelper::map($matches, 'id', 'name');
            $players = ArrayHelper::map($players, 'id', 'name');
            if (!empty($matchPlayers)) {
                foreach ($matchPlayers as $key => $player) {
                    $matchPlayers[$key]['name'] = $matches[$player['match_id']] . ' - ' . $players[$player['player_id']];
                }
            }
            return $this->render('create', [
                'model' => $model,
                'players' => $matchPlayers,
            ]);
        }
    }

    public function actionUpdate($id) {
        $record = $this->findModel($id);
        $model = new $this->modelClass($this->table, self::ROLE_UPDATE);
        $model->setModel($record);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            $matchPlayers = Yii::$app->dbHelper->getAll('match_player');
            $matches = Yii::$app->dbHelper->getAll('match');
            $matchdays =  ArrayHelper::map(Yii::$app->dbHelper->getAll('matchday'), 'id', 'name');
            $teams = ArrayHelper::map(Yii::$app->dbHelper->getAll('team'), 'id', 'name');
            $players = Yii::$app->dbHelper->getAll('player');
            if (!empty($matches)) {
                foreach ($matches as $key => $match) {
                    $matches[$key]['name'] = $matchdays[$match['matchday_id']] . ': '
                            . $teams[$match['home_team_id']] . ' - ' . $teams[$match['guest_team_id']];
                }
            }
            if (!empty($players)) {
                foreach ($players as $key => $player) {
                    $players[$key]['name'] = $player['first_name'] . ' ' . $player['last_name']
                            . ' - ' . $teams[$player['team_id']];
                }
            }
            $matches = ArrayHelper::map($matches, 'id', 'name');
            $players = ArrayHelper::map($players, 'id', 'name');
            if (!empty($matchPlayers)) {
                foreach ($matchPlayers as $key => $player) {
                    $matchPlayers[$key]['name'] = $matches[$player['match_id']] . ' - ' . $players[$player['player_id']];
                }
            }
            return $this->render('update', [
                'model' => $model,
                'players' => $matchPlayers,
            ]);
        }
    }

}
