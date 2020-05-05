<?php

use yii\db\Migration;

/**
 * Class m200504_134930_time_prices
 */
class m200428_142707_time_prices extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('time_prices', [
            'id' => $this->primaryKey(),
            'price' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('time_prices');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200504_134930_time_prices cannot be reverted.\n";

        return false;
    }
    */
}
