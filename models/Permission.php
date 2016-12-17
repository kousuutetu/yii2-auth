<?php

namespace maple\auth\models;

use Yii;
use yii\helpers\ArrayHelper;

class Permission extends Item
{
    /**
     * @inheritdoc
     */
    public $type = self::TYPE_PERMISSION;

    /**
     * @inheritdoc
     */
    public $needCrud;

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
            ['needCrud', 'safe'],
            ['name', 'unique']
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
            'needCrud' => Yii::t('app', 'need CRUD'),
            'rule_name' => Yii::t('app', 'Rule Name'),
            'data' => Yii::t('app', 'Data'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function addPermissions()
    {
        $this->addPermission($this->name, $this->description);
        if ($this->needCrud) {
            $crud = [
                'create'    => Yii::t('app', 'Create'),
                'view'      => Yii::t('app', 'View'),
                'update'    => Yii::t('app', 'Update'),
                'delete'    => Yii::t('app', 'Delete'),
            ];
            foreach ($crud as $key => $val) {
                $this->addPermission(rtrim($this->name, '/').'/'.$key, $this->description.'-'.$val);
            }
        }
    }

    public function addPermission($name, $description)
    {
        $auth = Yii::$app->getAuthManager();
        $permission = $auth->createPermission('/'.trim($name, '/'));
        $permission->description = $description;
        $auth->add($permission);
    }

    public static function getPermission($name)
    {
        $auth = Yii::$app->getAuthManager();
        $permission = $auth->getPermission($name);

        $permissionMap = [];
        if ($permission) {
            $permissionMap[$permission->name] = $permission->description;
        }

        return $permissionMap;
    }

    public static function getPermissions()
    {
        return self::getPermissionMulti('getPermissions');
    }

    public static function getPermissionsByRole($roleName)
    {
        return self::getPermissionMulti('getPermissionsByRole', $roleName);
    }

    public static function getPermissionsByUser($userId)
    {
        return self::getPermissionMulti('getPermissionsByUser', $userId);
    }

    public static function getPermissionMulti($function, $param = null)
    {
        $auth = Yii::$app->getAuthManager();
        $permissions = $auth->$function($param);

        $permissionsMap = [];
        if ($permissions) {
            $permissionsArray = ArrayHelper::toArray($permissions, [
                'yii\rbac\Permission' => ['name', 'description']
            ]);
            $permissionsMap = ArrayHelper::map($permissionsArray, 'name', 'description');
        }

        return $permissionsMap;
    }
}
