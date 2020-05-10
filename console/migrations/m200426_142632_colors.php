<?php

use yii\db\Migration;

/**
 * Class m200509_135003_colors
 */
class m200426_142632_colors extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('colors', [
            'id' => $this->primaryKey(),
            'color' => $this->string('255'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('colors');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200509_135003_colors cannot be reverted.\n";

        return false;
    }
    */
}
