<?php

namespace backend\controllers;

class PlayerController extends \backend\components\CRUDController {

    public $table = 'player';
    public $modelClass = 'backend\models\PlayerForm';

}
