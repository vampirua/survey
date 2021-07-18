<?php

namespace console\controllers;

use Faker\Factory;
use common\models\User;

class UserCreateController extends \yii\console\Controller {
    public function actionCreateUser($user) {
        $faker = Factory::create();
        if ($user === 'admin') {
            /** @var  $newUser User */
            $newUser = new User();
            $newUser->name = 'admin';
            $newUser->password = '123456';
            $newUser->first_name = $faker->name;
            $newUser->last_name = $faker->name;
            $newUser->ref_user_group = 1;
            $newUser->registered_at = date('Y-m-d');
            $newUser->save();
        } elseif ($user === 'user') {
            /** @var  $newUser User */
            $newUser = new User();
            $newUser->name = 'user';
            $newUser->password = '123456';
            $newUser->first_name = $faker->name;
            $newUser->last_name = $faker->name;
            $newUser->ref_user_group = 2;
            $newUser->registered_at = date('Y-m-d');
            $newUser->save();
        }
    }
}