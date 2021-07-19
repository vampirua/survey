<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginFormAdmin extends Model {
    public $username;
    public $password;
    private $_user;

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
        ];
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login() {
        if ($this->validate()) {
            $user = $this->getUser();
            if ($user === null) {
                return false;
            }

            if ($user->ref_user_group === 1) {
                return Yii::$app->user->login($this->getUser());
            }
        }

        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser() {
        if ($this->_user === null) {
            $this->_user = User::find()
                               ->andWhere(['name' => $this->username])
                               ->andWhere(['password' => $this->password])
                               ->one();
        }

        return $this->_user;
    }
}
