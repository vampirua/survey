<?php

namespace common\models;

use backend\service\JsonBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "fields".
 *
 * @property int $id
 * @property string|null $display_name
 * @property string|null $name
 * @property int|null $ref_field_type
 * @property int|null $created_by
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $updated_by
 *
 * @property FormFields[] $formFields
 */
class Fields extends \yii\db\ActiveRecord {
    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'fields';
    }

    public function behaviors() {
        return ArrayHelper::merge([
            'datetime' => [
                'class' => TimestampBehavior::class,
            ],

            'serialize' => [
                'class' => JsonBehavior::class,
                'fields' => [
                    'variant',
                ],
            ],
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ], parent::behaviors());
    }

    const TYPE_TEXT = 1;
    const TYPE_SELECT = 2;
    const TYPE_CHECKBOX = 3;
    const TYPE_DATE = 4;

    public static function getTypes() {
        return [
            self::TYPE_TEXT => 'text',
            self::TYPE_SELECT => 'select',
            self::TYPE_CHECKBOX => 'checkbox',
            self::TYPE_DATE => 'date',
        ];
    }

    public static function getType($code) {
        return self::getTypes()[$code];
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['ref_field_type', 'created_by', 'created_at', 'updated_at','updated_by'], 'integer'],
            [['display_name', 'name'], 'string', 'max' => 255],
            [['variant'], 'safe'],
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
            'display_name' => 'Display Name',
            'name' => 'Name',
            'ref_field_type' => 'Ref Field Type',
            'created_by' => 'Create By',
            'created_at' => 'Create At',
            'updated_at' => 'Update At',
            'variant' => 'Write variant',
        ];
    }

    /**
     * Gets query for [[FormFields]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFormFields() {
        return $this->hasMany(FormFields::class, ['ref_filed' => 'id']);
    }

    public function getCreatedBy() {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
}
