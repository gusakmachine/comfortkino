<?php

use yii\db\Migration;

/**
 * Class m200523_110146_svg_icons
 */
class m200523_110146_svg_icons extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('svg_icons', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('svg_icons');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200523_110146_svg_icons cannot be reverted.\n";

        return false;
    }
    */
}
