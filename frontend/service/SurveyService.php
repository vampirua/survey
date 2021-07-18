<?php

namespace frontend\service;

use common\models\UserFormResults;
use yii\helpers\Json;

class SurveyService {
    public function saveSurvey($post, $formID) {
        unset($post['_csrf-frontend']);

        /* @var  $newSurvey UserFormResults */
        $newSurvey = new UserFormResults();
        $newSurvey->ref_user = \Yii::$app->user->id;
        $newSurvey->ref_form = $formID;
        $newSurvey->values = $post;
        $newSurvey->create_at = time();
        $newSurvey->save();
    }
}