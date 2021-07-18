<?php

namespace frontend\helpers;

use common\models\Fields;
use yii\helpers\Html;

class HtmlHelpers
{
    static public function getHtmlFields($field)
    {
        /* @var $field Fields */

        switch ($field->ref_field_type) {

            case 1 :
                $html = $field->name.' '. ':'.' ' . Html::input('text', $field->display_name);
                return $html;

            case 2 :
                $html = $field->name .' '. ':'.' ' . Html::dropDownList($field->name, '', $field->variant);
                return $html;

            case 3 :
                $html = $field->name .' '. ':'.' ' . Html::checkboxList($field->name,'',$field->variant);
                return $html;
            case 4 :
                $html = $field->name .' '. ':'.' ' . Html::input('date', $field->display_name);
                return $html;

        }


    }

}