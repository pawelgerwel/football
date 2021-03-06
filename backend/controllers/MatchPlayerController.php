<?php

namespace backend\controllers;

use yii\helpers\ArrayHelper;
use Yii;

class MatchPlayerController extends \backend\components\CRUDController {

    public $table = 'match_player';
    public $modelClass = 'backend\models\MatchPlayerForm';

    public function actionCreate() {
        $model = new $this->modelClass($this->table, self::ROLE_CREATE);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->getId()]);
        } else {
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
            return $this->render('create', [
                'model' => $model,
                'matches' => $matches,
                'players' => $players,
            ]);
        }
    }

    public function actionUpdate($id) {
        $record = $this->findModel($id);
        $model = new $this->modelClass($this->table, self::ROLE_UPDATE);
        $model->setModel($record);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->getId()]);
        } else {
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
            return $this->render('update', [
                'model' => $model,
                'matches' => $matches,
                'players' => $players,
                'record' => $record,
            ]);
        }
    }

}
