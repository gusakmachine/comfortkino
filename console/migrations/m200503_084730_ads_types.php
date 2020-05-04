<?php

use yii\db\Migration;

/**
 * Class m200503_084734_ads_types
 */
class m200503_084730_ads_types extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ads_types', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('ads_types');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200503_084734_ads_types cannot be reverted.\n";

        return false;
    }
    */
}
