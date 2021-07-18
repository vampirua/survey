<?php

namespace common\models;

use backend\service\JsonBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "user_form_results".
 *
 * @property int $id
 * @property int|null $ref_user
 * @property int|null $ref_form
 * @property string|null $values
 * @property int|null $create_at
 *
 * @property Forms $refForm
 * @property User $refUser
 */
class UserFormResults extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_form_results';
    }

    public function behaviors()
    {
        return ArrayHelper::merge([
            'serialize' => [
                'class' => JsonBehavior::class,
                'fields' => [
                    'values',
                ],
            ],
        ], parent::behaviors());
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ref_user', 'ref_form', 'create_at'], 'integer'],
            [['values'], 'safe'],
            [['ref_form'], 'exist', 'skipOnError' => true, 'targetClass' => Forms::class, 'targetAttribute' => ['ref_form' => 'id']],
            [['ref_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['ref_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ref_user' => 'User',
            'ref_form' => 'Form name',
            'values' => 'Values',
            'create_at' => 'Create At',
        ];
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

    /**
     * Gets query for [[RefUser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefUser()
    {
        return $this->hasOne(User::class, ['id' => 'ref_user']);
    }
}
