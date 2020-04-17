<?php

use yii\db\Migration;

/**
 * Class m200416_125615_sessions_time
 */
class m200416_125615_sessions_time extends Migration
{
        public function safeUp()
        {
            $this->createTable('{{%sessions_time}}', [
                'id' => $this->primaryKey(),
                'time' => $this->time(),
            ]);
        }

        public function safeDown()
        {
            $this->dropTable('{{%sessions_time}}');
        }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200416_125615_sessions_time cannot be reverted.\n";

        return false;
    }
    */
}
