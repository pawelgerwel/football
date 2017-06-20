<?php

namespace backend\components;

use Yii;

class CRUDController extends \yii\web\Controller {

    const ROLE_CREATE = 0;
    const ROLE_UPDATE = 1;

    public $table;
    public $modelClass;

    public function behaviors() {
        return [
            'verbs' => [
                'class' => \yii\filters\VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex() {
        $models = Yii::$app->dbHelper->getAll($this->table);
        return $this->render('index', ['models' => $models]);
    }

    public function actionCreate() {
        $model = new $this->modelClass($this->table, self::ROLE_CREATE);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->getId()]);
        } else {
            return $this->render('create', ['model' => $model]);
        }
    }

    public function actionView($id) {
        $model = $this->findModel($id);
        return $this->render('view', ['model' => $model]);
    }

    public function actionUpdate($id) {
        $record = $this->findModel($id);
        $model = new $this->modelClass($this->table, self::ROLE_UPDATE);
        $model->setModel($record);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->getId()]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'record' => $record,
            ]);
        }
    }

    public function actionDelete($id) {
        Yii::$app->dbHelper->deleteOne($this->table, $id);
        return $this->redirect(['index']);
    }

    protected function findModel($id) {
        if (($model = Yii::$app->dbHelper->getOne($this->table, $id)) !== false) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function beforeAction($action) {
        if (!parent::beforeAction($action)) {
            return false;
        }
        $this->view->params['activeController'] = $this->id;
        return true;
    }

}
