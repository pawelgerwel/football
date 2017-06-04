<?php

namespace backend\controllers;

class CountryController extends \backend\components\CRUDController {

    public $table = 'country';
    public $modelClass = 'backend\models\CountryForm';

}
