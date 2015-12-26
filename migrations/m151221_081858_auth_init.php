<?php

use yii\db\Schema;
use yii\db\Migration;

class m151221_081858_auth_init extends Migration
{
    public function up()
    {
        $this->insert('auth_user', [
            'username' => 'Jeff',
            'password_hash' => \Yii::$app->security->generatePasswordHash('super.human'),
            'email' => 'kousuutetu@163.com',
            'auth_key' => \Yii::$app->security->generateRandomString(),
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $item = [
            ['name' => '/auth/assignment', 'type' => 2, 'description' => '权限-分配'],
            ['name' => '/auth/permission', 'type' => 2, 'description' => '权限-许可'],
            ['name' => '/auth/permission/create', 'type' => 2, 'description' => '权限-许可-创建'],
            ['name' => '/auth/permission/delete', 'type' => 2, 'description' => '权限-许可-删除'],
            ['name' => '/auth/permission/view', 'type' => 2, 'description' => '权限-许可-查看'],
            ['name' => '/auth/role', 'type' => 2, 'description' => '权限-角色'],
            ['name' => '/auth/role/create', 'type' => 2, 'description' => '权限-角色-创建'],
            ['name' => '/auth/role/delete', 'type' => 2, 'description' => '权限-角色-删除'],
            ['name' => '/auth/role/view', 'type' => 2, 'description' => '权限-角色-查看'],
            ['name' => '/auth/role/update', 'type' => 2, 'description' => '权限-角色-更新'],
            ['name' => '/auth/user', 'type' => 2, 'description' => '权限-用户'],
            ['name' => '/auth/user/create', 'type' => 2, 'description' => '权限-用户-创建'],
            ['name' => '/auth/user/delete', 'type' => 2, 'description' => '权限-用户-删除'],
            ['name' => '/auth/user/view', 'type' => 2, 'description' => '权限-用户-查看'],
            ['name' => '/auth/user/update', 'type' => 2, 'description' => '权限-用户-更新'],
            ['name' => 'administrator', 'type' => 1, 'description' => '管理员'],
        ];
        foreach ($item as $val) {
            $this->insert('auth_item', [
                'name' => $val['name'],
                'type' => $val['type'],
                'description' => $val['description'],
                'created_at' => time(),
                'updated_at' => time(),
            ]);
        }

        $itemChild = [
            ['parent' => 'administrator', 'child' => '/auth/assignment'],
            ['parent' => 'administrator', 'child' => '/auth/permission'],
            ['parent' => 'administrator', 'child' => '/auth/permission/create'],
            ['parent' => 'administrator', 'child' => '/auth/permission/delete'],
            ['parent' => 'administrator', 'child' => '/auth/permission/view'],
            ['parent' => 'administrator', 'child' => '/auth/role'],
            ['parent' => 'administrator', 'child' => '/auth/role/create'],
            ['parent' => 'administrator', 'child' => '/auth/role/delete'],
            ['parent' => 'administrator', 'child' => '/auth/role/view'],
            ['parent' => 'administrator', 'child' => '/auth/role/update'],
            ['parent' => 'administrator', 'child' => '/auth/user'],
            ['parent' => 'administrator', 'child' => '/auth/user/create'],
            ['parent' => 'administrator', 'child' => '/auth/user/delete'],
            ['parent' => 'administrator', 'child' => '/auth/user/view'],
            ['parent' => 'administrator', 'child' => '/auth/user/update'],
        ];
        foreach ($itemChild as $val) {
            $this->insert('auth_item_child', [
                'parent' => $val['parent'],
                'child' => $val['child'],
            ]);
        }

        $this->insert('auth_assignment', [
            'item_name' => 'administrator',
            'user_id' => 1,
            'created_at' => time(),
        ]);
    }
}

