<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

class SignupForm extends Model
{
    public $username;
    public $password;
    public $confirm_password;

    public function rules()
    {
        return [
            [['username', 'password', 'confirm_password'], 'required'],
            ['username', 'string', 'min' => 4, 'max' => 255],
            ['username', 'unique', 'targetClass' => User::class, 'message' => 'This username has already been taken.'],
            ['password', 'string', 'min' => 6],
            ['confirm_password', 'compare', 'compareAttribute' => 'password', 'message' => 'Passwords do not match.'],
        ];
    }

    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = $this->createUserInstance();
        $user->username = $this->username;
        $user->password_hash = Yii::$app->security->generatePasswordHash($this->password);
        $user->auth_key = Yii::$app->security->generateRandomString();
        $user->access_token = Yii::$app->security->generateRandomString();

        return $user->save() ? $user : null;
    }

    protected function createUserInstance()
    {
        return new User();
    }
}
