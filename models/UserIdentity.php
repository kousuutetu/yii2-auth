<?php
namespace Jeff\auth\models;

use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;
use Jeff\auth\models\User;

class UserIdentity extends \yii\base\Object implements IdentityInterface
{
    public $id;
    public $username;
    public $password_hash;
    public $auth_key;
    public $access_token;

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        $user = User::find()->where(['id' => $id])->asArray()->one();
        if ($user) {
            return new static([
                'id' => $user['id'],
                'username' => $user['username'],
                'password_hash' => $user['password_hash'],
                'auth_key' => $user['auth_key'],
                'access_token' => $user['access_token'],
            ]);
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $user = User::find()->where(['access_token' => $token])->asArray()->one();
        if ($user['access_token'] === $token) {
            return new static([
                'id' => $user['id'],
                'username' => $user['username'],
                'password_hash' => $user['password_hash'],
                'auth_key' => $user['auth_key'],
                'access_token' => $user['access_token'],
            ]);
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $user = User::find()->where(['username' => $username])->asArray()->one();
        if ($user) {
            return new static([
                'id' => $user['id'],
                'username' => $user['username'],
                'password_hash' => $user['password_hash'],
                'auth_key' => $user['auth_key'],
                'access_token' => $user['access_token'],
            ]);
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
}
