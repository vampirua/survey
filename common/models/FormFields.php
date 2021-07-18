<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "form_fields".
 *
 * @property int $id
 * @property int|null $ref_form
 * @property int|null $ref_filed
 * @property string|null $display_name
 * @property int|null $sort
 *
 * @property Fields $refFiled
 * @property Forms $refForm
 */
class FormFields extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'form_fields';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ref_form', 'ref_filed', 'sort'], 'integer'],
            [['display_name'], 'string', 'max' => 255],
            [['ref_filed'], 'exist', 'skipOnError' => true, 'targetClass' => Fields::class, 'targetAttribute' => ['ref_filed' => 'id']],
            [['ref_form'], 'exist', 'skipOnError' => true, 'targetClass' => Forms::class, 'targetAttribute' => ['ref_form' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ref_form' => 'Ref Form',
            'ref_filed' => 'Ref Filed',
            'display_name' => 'Display Name',
            'sort' => 'Sort',
        ];
    }

    /**
     * Gets query for [[RefFiled]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefFiled()
    {
        return $this->hasOne(Fields::class, ['id' => 'ref_filed']);
    }

    /**
     * Gets query for [[RefForm]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefForm()
    {
        return $this->hasOne(Forms::class, ['id' => 'ref_form']);
    }
}