<?php

namespace backend\service;

use common\models\Fields;
use common\models\FormFields;

class FormService {
    public function saveFieldsForm($formID, $sortFieldsID) {
        $index = 0;
        $ids = explode(",", $sortFieldsID);
        $hasFields = FormFields::find()
                               ->select('ref_filed')
                               ->indexBy('id')
                               ->andWhere(['ref_form' => $formID])
                               ->column();

        foreach ($ids as $fieldID) {
            if (in_array($fieldID, $hasFields)) {
                $formFields = FormFields::find()
                                        ->andWhere(['ref_form' => $formID])
                                        ->andWhere(['ref_filed' => $fieldID])
                                        ->one();
                $formFields->sort = $index++;
                $formFields->update();
            } else {
                $newFormFields = new FormFields();
                $newFormFields->ref_form = $formID;
                $newFormFields->ref_filed = $fieldID;
                $newFormFields->sort = $index++;
                $newFormFields->save();
            }
        }

        foreach ($hasFields as $id => $field) {
            if (in_array($field, $ids)) {
                continue;
            }

            $field = FormFields::find()->andWhere(['id' => $id])->one();
            $field->delete();
        }
    }

    public function getFields($formID) {

        $fields = Fields::find()->all();
        $hasFields = FormFields::find()
                               ->with('refFiled')
                               ->indexBy('ref_filed')
                               ->andWhere(['ref_form' => $formID])
                               ->orderBy('sort')
                               ->all();

        $sortFields = [];
        $hasFieldsForms = [];

        /* @var Fields $field */
        foreach ($fields as $field) {
            if (array_key_exists($field->id, $hasFields)) {
                continue;
            }

            $sortFields[$field->id] = ['content' => $field->name];
        }
        foreach ($hasFields as $field) {
            $hasFieldsForms[$field->ref_filed] = ['content' => $field->refFiled->name];
        }

        return ['hasFieldsForms' => $hasFieldsForms, 'sortFields' => $sortFields];
    }
}