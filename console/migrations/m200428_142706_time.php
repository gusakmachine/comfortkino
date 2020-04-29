<?php

use yii\db\Migration;

/**
 * Class m200428_144542_time
 */
class m200428_142706_time extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('time', [
            'id' => $this->primaryKey(),
            'time' => $this->time(255),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('time');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200428_144542_time cannot be reverted.\n";

        return false;
    }
    */
}
