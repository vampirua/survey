<?php

use yii\db\Migration;

/**
 * Class m210713_064522_create_db_user_survey
 */
class m210713_064522_create_db_user_survey extends Migration {
    public function up() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'ref_user_group' => $this->integer(),
            'name' => $this->string()->notNull()->unique(),
            'password' => $this->string(32)->notNull(),
            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
            'registered_at' => $this->string()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%user_form_results}}', [
            'id' => $this->primaryKey(),
            'ref_user' => $this->integer()->notNull(),
            'ref_form' => $this->integer()->notNull(),
            'values' => $this->string()->notNull(),
            'create_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%forms}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%form_fields}}', [
            'id' => $this->primaryKey(),
            'ref_form' => $this->integer()->notNull(),
            'ref_filed' => $this->integer()->notNull(),
            'display_name' => $this->string()->notNull(),
            'sort' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%fields}}', [
            'id' => $this->primaryKey(),
            'variant' => $this->text(),
            'display_name' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'ref_field_type' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),

        ], $tableOptions);

        $this->addForeignKey(
            'user_forms-fk',
            '{{%forms}}',
            'created_by',
            '{{%users}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'user_fields
            -fk',
            '{{%fields}}',
            'created_by',
            '{{%users}}',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'user_form_results-users-fk',
            '{{%user_form_results}}',
            'ref_user',
            '{{%users}}',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'user_form_results-form_fields-fk',
            '{{%user_form_results}}',
            'ref_form',
            '{{%forms}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fields-form_fields-fk',
            '{{%form_fields}}',
            'ref_filed',
            '{{%fields}}',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'forms-form_fields-fk',
            '{{%form_fields}}',
            'ref_form',
            '{{%forms}}',
            'id',
            'CASCADE'
        );
    }

    public function down() {
        $this->dropForeignKey('user_form_results-users-fk', '{{%user_form_results}}');
        $this->dropForeignKey('user_form_results-form_fields-fk', '{{%user_form_results}}');
        $this->dropForeignKey('fields-form_fields-fk', '{{%form_fields}}');
        $this->dropForeignKey('forms-form_fields-fk', '{{%form_fields}}');

        $this->dropTable('{{%fields}}');
        $this->dropTable('{{%form_fields}}');
        $this->dropTable('{{%forms}}');
        $this->dropTable('{{%user_form_results}}');
        $this->dropTable('{{%users}}');
    }
}
