<?php

namespace backend\service;

use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\helpers\Json;

class JsonBehavior extends Behavior {
    public $fields = [];
    public $default = [];

    public function events() {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'encode',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'encode',
            ActiveRecord::EVENT_AFTER_FIND => 'decode',
            ActiveRecord::EVENT_AFTER_INSERT => 'decode',
            ActiveRecord::EVENT_AFTER_UPDATE => 'decode',
        ];
    }

    public function encode() {
        $model = $this->owner;
        foreach ($this->fields as $field) {
            if (isset($model->$field)) {
                $model->$field = Json::encode($model->$field);
            }
        }
    }

    public function decode() {
        $model = $this->owner;
        foreach ($this->fields as $field) {
            $model->$field = empty($model->$field) ? $this->default : Json::decode($model->$field);
        }
    }
} 