<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property int|null $ref_user_group
 * @property string $name
 * @property string $password
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $registered_at
 *
 * @property Forms[] $forms
 * @property UserFormResults[] $userFormResults
 */
class User extends ActiveRecord implements IdentityInterface {
    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return '{{%users}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['ref_user_group'], 'integer'],
            [['name', 'password'], 'required'],
            [['name', 'first_name', 'last_name', 'registered_at'], 'string', 'max' => 255],
            [['password'], 'string', 'max' => 32],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'ref_user_group' => 'Ref User Group',
            'name' => 'Name',
            'password' => 'Password',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'registered_at' => 'Registered At',
        ];
    }

    /**
     * Gets query for [[Forms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getForms() {
        return $this->hasMany(Forms::className(), ['ref_user' => 'id']);
    }

    /**
     * Gets query for [[UserFormResults]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserFormResults() {
        return $this->hasMany(UserFormResults::className(), ['ref_user' => 'id']);
    }

    public function getId() {
        return $this->getPrimaryKey();
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    public function getAuthKey() {
        // TODO: Implement getAuthKey() method.
    }

    public function validateAuthKey($authKey) {
        // TODO: Implement validateAuthKey() method.
    }

    public static function findIdentity($id) {
        return static::findOne($id);
    }
}
