<?php

namespace Jeff\auth\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "auth_assignment".
 *
 * @property string $item_name
 * @property string $user_id
 * @property integer $created_at
 *
 * @property Item $itemName
 */
class Assignment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auth_assignment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['user_id', 'required'],
            ['created_at', 'integer'],
            ['item_name', 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'item_name' => Yii::t('app', 'Role'),
            'user_id' => Yii::t('app', 'User'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemName()
    {
        return $this->hasOne(Item::className(), ['name' => 'item_name']);
    }

    public static function getAssignments($userId)
    {
        $auth = Yii::$app->getAuthManager();
        $assignments = $auth->getAssignments($userId);

        $roleMap = [];
        if ($assignments) {
            $roleArray = ArrayHelper::toArray($assignments, [
                'yii\rbac\Assignment' => ['roleName']
            ]);

            $roleMap = array_keys($roleArray);
        }
        return $roleMap;
    }

    public function assignments()
    {
        $auth = Yii::$app->getAuthManager();
        $auth->revokeAll($this->user_id);

        $items = is_array($this->item_name) ? $this->item_name : [];
        foreach ($items as $item) {
            $role = $auth->getRole($item);
            $auth->assign($role, $this->user_id);
        }
    }
}
