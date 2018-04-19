<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'auth_key' => $this->string()->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->createTable('auth', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'source' => $this->string()->notNull(),
            'source_id' => $this->string()->notNull(),
        ]);

        $this->addForeignKey('fk-auth-user_id-user-id', 'auth', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');

        $this->insert('user', [
            'username' => 'admin',
            'auth_key' => 'RJW9oDoQ8PenysoV0ZXyBP0QzTMZyqB_',
            'password_hash' => '$2y$13$sB8mPOSI53Q6gi4ScSKZPumc96hHxXNybnjWHswbegoSWRaMpxTUO',
            'email' => 'admin@admin.admin',
            'status' => 10,
            'created_at' => 1524121037,
            'updated_at' => 1524121037
        ]);

        $this->insert('user', [
            'username' => 'user',
            'auth_key' => '5sUjgc-BChHXWJJeJBVXhuX43WkIxB2A',
            'password_hash' => '$2y$13$4rJNY2JaxDYrhctllsidQ.7JSIM468aGxiGDqEJ8QxPaGQYifxiCu',
            'email' => 'user@user.com',
            'status' => 10,
            'created_at' => 1524121563,
            'updated_at' => 1524121563
        ]);
    }

    public function down()
    {
        $this->dropTable('auth');
        $this->dropTable('user');
    }
}
