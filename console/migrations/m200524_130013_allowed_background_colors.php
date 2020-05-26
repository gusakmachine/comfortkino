<?php

use yii\db\Migration;

/**
 * Class m200524_130013_allowed_background_colors
 */
class m200524_130013_allowed_background_colors extends Migration
{
    /**
     * {@inheritdoc}
     */
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('allowed_background_colors', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('allowed_background_colors');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200524_130013_allowed_background_colors cannot be reverted.\n";

        return false;
    }
    */
}
