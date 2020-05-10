<?php

use yii\db\Migration;

/**
 * Class m200509_134714_place_prices
 */
class m200426_142631_place_prices extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('place_prices', [
            'id' => $this->primaryKey(),
            'price' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('place_prices');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200509_134714_place_prices cannot be reverted.\n";

        return false;
    }
    */
}
