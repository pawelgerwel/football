<?php

namespace common\components;

use yii\helpers\ArrayHelper;

class Dictionary extends \yii\base\Component {

    const POSITION_GOALKEEPER = 0;
    const POSITION_DEFENDER = 1;
    const POSITION_MIDFIELDER = 2;
    const POSITION_FORWARD = 3;

    const COACH_TYPE_HEAD = 0;
    const COACH_TYPE_ASSISTANT = 1;
    const COACH_TYPE_GOALKEEPING = 2;
    const COACH_TYPE_FITNESS = 3;

    public function getPositions() {
        return [
            self::POSITION_GOALKEEPER,
            self::POSITION_DEFENDER,
            self::POSITION_MIDFIELDER,
            self::POSITION_FORWARD
        ];
    }

    public function getPositionLabels($key = false) {
        $elements = [
            self::POSITION_GOALKEEPER => 'Goalkeeper',
            self::POSITION_DEFENDER => 'Defender',
            self::POSITION_MIDFIELDER => 'Midfielder',
            self::POSITION_FORWARD => 'Forward'
        ];
        return $key === false ? $elements : ArrayHelper::getValue($elements, $key);
    }

    public function getCoachTypes() {
        return [
            self::COACH_TYPE_HEAD,
            self::COACH_TYPE_ASSISTANT,
            self::COACH_TYPE_GOALKEEPING,
            self::COACH_TYPE_FITNESS
        ];
    }

    public function getCoachTypeLabels($key = false) {
        $elements = [
            self::COACH_TYPE_HEAD => 'Head coach',
            self::COACH_TYPE_ASSISTANT => 'Assistant coach',
            self::COACH_TYPE_GOALKEEPING => 'Goalkeeping coach',
            self::COACH_TYPE_FITNESS => 'Fitness coach'
        ];
        return $key === false ? $elements : ArrayHelper::getValue($elements, $key);
    }

}
