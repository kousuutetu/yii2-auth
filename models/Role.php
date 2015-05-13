<?php

namespace Jeff\auth\models;

use Yii;
use yii\helpers\ArrayHelper;

class Role extends Item
{
    /**
     * @inheritdoc
     */
    public $type = self::TYPE_ROLE;

    public $permission;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['type', 'created_at', 'updated_at'], 'integer'],
            [['description', 'data'], 'string'],
            [['name', 'rule_name'], 'string', 'max' => 64],
            ['name', 'unique'],
            ['permission', 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Name'),
            'type' => Yii::t('app', 'Type'),
            'description' => Yii::t('app', 'Description'),
            'permission' => Yii::t('app', 'Permission'),
            'rule_name' => Yii::t('app', 'Rule Name'),
            'data' => Yii::t('app', 'Data'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function addRole()
    {
        $auth = Yii::$app->getAuthManager();
        $role = $auth->createRole($this->name);
        $role->description = $this->description;
        $auth->add($role);

        $this->addPermission($role, $this->permission);
    }

    public function updateRole()
    {
        $auth = Yii::$app->getAuthManager();

        $oldRoleName        = $this->getOldAttribute('name');
        $role               = $auth->getRole($oldRoleName);
        $auth->removeChildren($role);
        $role->name         = $this->name;
        $role->description  = $this->description;
        $auth->update($oldRoleName, $role);

        $this->addPermission($role, $this->permission);
    }

    public function addPermission($role, $items)
    {
        $auth = Yii::$app->getAuthManager();
        if (!is_array($items)) {
            $items = [];
        }
        foreach($items as $item) {
            $objectItem = $auth->getPermission($item);
            if ($objectItem) {
                $auth->addChild($role, $objectItem);
            }
        }
    }

    public static function getRoles()
    {
        return self::getRoleMulti('getRoles');
    }

    public static function getRolesByUser($userId)
    {
        return self::getRoleMulti('getRolesByUser', $userId);
    }

    public static function getRoleMulti($function, $param = null)
    {
        $auth = Yii::$app->getAuthManager();
        $roles = $auth->$function($param);

        $roleMap = [];
        if ($roles) {
            $roleArray = ArrayHelper::toArray($roles, [
                'yii\rbac\Role' => ['name', 'description']
            ]);
            $roleMap = ArrayHelper::map($roleArray, 'name', 'description');
        }

        return $roleMap;
    }
}
