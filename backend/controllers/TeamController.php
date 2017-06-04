<?php

namespace backend\controllers;

class TeamController extends \backend\components\CRUDController {

    public $table = 'team';
    public $modelClass = 'backend\models\TeamForm';

}
