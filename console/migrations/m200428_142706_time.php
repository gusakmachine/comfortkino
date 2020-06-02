<?php

use yii\db\Migration;

/**
 * Class m200428_144542_time
 */
class m200428_142706_time extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('times', [
            'id' => $this->primaryKey(),
            'time' => $this->time(255),
            'price' => $this->integer(),
            'sessions_id' => $this->integer(),
        ]);

        // creates index for column `sessions_id`
        $this->createIndex(
            '{{%idx-times-sessions_id}}',
            '{{%times}}',
            'sessions_id'
        );

        // add foreign key for table `{{%sessions}}`
        $this->addForeignKey(
            '{{%fk-times-sessions_id}}',
            '{{%times}}',
            'sessions_id',
            '{{%sessions}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%sessions}}`
        $this->dropForeignKey(
            '{{%fk-times-sessions_id}}',
            '{{%times}}'
        );

        // drops index for column `sessions_id`
        $this->dropIndex(
            '{{%idx-times-sessions_id}}',
            '{{%times}}'
        );

        $this->dropTable('times');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200428_144542_time cannot be reverted.\n";

        return false;
    }
    */
}
