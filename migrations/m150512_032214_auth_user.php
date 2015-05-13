<?php

use yii\db\Schema;
use yii\db\Migration;

class m150512_032214_auth_user extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('auth_user', [
            'id'                    => Schema::TYPE_PK,
            'username'              => Schema::TYPE_STRING . '(128) NOT NULL',
            'password_hash'         => Schema::TYPE_STRING . '(60) NOT NULL',
            'password_reset_token'  => Schema::TYPE_STRING . '(43) NOT NULL DEFAULT ""',
            'email'                 => Schema::TYPE_STRING . '(32) NOT NULL',
            'access_token'          => Schema::TYPE_STRING . '(60) NOT NULL DEFAULT ""',
            'auth_key'              => Schema::TYPE_STRING . '(32) NOT NULL',
            'status'                => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT "10"',
            'created_at'            => Schema::TYPE_INTEGER,
            'updated_at'            => Schema::TYPE_INTEGER,
            'UNIQUE KEY `user-username` (`username`)',
            'UNIQUE KEY `user-email` (`email`)'
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('auth_user');
    }
}
