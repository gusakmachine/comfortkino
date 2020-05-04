<?php

use yii\db\Migration;

/**
 * Class m200503_084731_ads
 */
class m200503_084731_ads extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ads', [
            'id' => $this->primaryKey(),
            'type_id' => $this->integer(),
            'text' => $this->text(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->createIndex(
            '{{%idx-ads-types_id}}',
            '{{%ads}}',
            'type_id'
        );

        $this->addForeignKey(
            '{{%fk-ads}}',
            '{{%ads}}',
            'type_id',
            '{{%ads_types}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            '{{%fk-ads}}',
            '{{%ads}}'
        );

        $this->dropIndex(
            '{{%idx-ads-types_id}}',
            '{{%ads}}'
        );

        $this->dropTable('ads');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200503_084731_ads cannot be reverted.\n";

        return false;
    }
    */
}
