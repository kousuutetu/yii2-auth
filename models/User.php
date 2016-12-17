<?php

namespace maple\auth\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\AttributeBehavior;

/**
 * This is the model class for table "auth_user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $access_token
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVED = 10;
    const STATUS_FORBIDDEN = 20;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auth_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password_hash', 'email'], 'required'],

            [['status', 'created_at', 'updated_at'], 'integer'],
            ['access_token', 'string', 'max' => 60],
            ['password_reset_token', 'string', 'max' => 43],
            ['auth_key', 'string', 'max' => 32],

            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'string', 'min' => 2, 'max' => 128],
            ['username', 'unique'],

            ['password_hash', 'string', 'min' => 6, 'max' => 60],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'string', 'max' => 32],
            ['email', 'email'],
            ['email', 'unique']
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    self::EVENT_BEFORE_INSERT => 'status',
                ],
                'value' => function ($event) {
                    return User::STATUS_ACTIVED;
                },
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'password_hash' => Yii::t('app', 'Password'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'Email'),
            'access_token' => Yii::t('app', 'Access Token'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates access token from username and sets it to the model
     *
     * @param string $password
     */
    public function generateAccessToken($username, $password)
    {
        $this->access_token = Yii::$app->security->generatePasswordHash($username.$password);
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public static function getStatus($item = null)
    {
        $items = [
            self::STATUS_ACTIVED    => Yii::t('app', 'Actived'),
            self::STATUS_FORBIDDEN  => Yii::t('app', 'Forbidden')
        ];

        if ($item !== null) {
            return isset($items[$item]) ? $items[$item] : '';
        } else {
            return $items;
        }
    }

    public static function getUsers()
    {
        $users = User::findAll(['status' => User::STATUS_ACTIVED]);

        $userArray = ArrayHelper::toArray($users, [
            'yii\rbac\Permission' => ['id', 'username']
        ]);
        $userMap = ArrayHelper::map($userArray, 'id', 'username');

        return $userMap;
    }
}
