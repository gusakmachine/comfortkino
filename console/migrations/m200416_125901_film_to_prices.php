<?php

use yii\db\Migration;

/**
 * Class m200416_125901_film_to_prices
 */
class m200416_125901_film_to_prices extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%film_to_prices}}', [
            'id' => $this->primaryKey(),
            'film_id' => $this->integer(11),
            'price_id' => $this->integer(11),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%film_to_prices}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200416_125901_film_to_prices cannot be reverted.\n";

        return false;
    }
    */
}
