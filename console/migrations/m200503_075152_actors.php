<?php

use yii\db\Migration;

/**
 * Class m200503_075152_actors
 */
class m200503_075152_actors extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('actors', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('actors');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200503_075152_actors cannot be reverted.\n";

        return false;
    }
    */
}
