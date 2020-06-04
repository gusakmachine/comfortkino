<?php

use yii\db\Migration;

/**
 * Class m200503_075158_directors
 */
class m200503_075158_directors extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('directors', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('directors');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200503_075158_directors cannot be reverted.\n";

        return false;
    }
    */
}
