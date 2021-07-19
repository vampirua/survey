<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model {
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

            return Yii::$app->user->login($user);
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
