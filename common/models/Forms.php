<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "forms".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $create_by
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $updated_by
 *
 * @property FormFields[] $formFields
 * @property UserFormResults[] $userFormResults
 * @property User $created_by
 */
class Forms extends \yii\db\ActiveRecord {
    public $create_form;
    public $fields;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'forms';
    }

    public function behaviors() {
        return ArrayHelper::merge([
            'datetime' => [
                'class' => TimestampBehavior::class,
            ],
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ], parent::behaviors());
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['created_by', 'created_at', 'updated_at','updated_by'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['create_form', 'fields'], 'safe'],
            [
                ['created_by'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::className(),
                'targetAttribute' => ['created_by' => 'id'],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'ref_user' => 'Author',
            'name' => 'Name',
            'created_by' => 'Create By',
            'created_at' => 'Create At',
            'updated_at' => 'Update At',
        ];
    }

    /**
     * Gets query for [[FormFields]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFormFields() {
        return $this->hasMany(FormFields::class, ['ref_form' => 'id']);
    }

    /**
     * Gets query for [[UserFormResults]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserFormResults() {
        return $this->hasMany(UserFormResults::class, ['ref_form' => 'id']);
    }
    public function getCreatedBy() {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
}
