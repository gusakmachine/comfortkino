git<?php

use yii\db\Migration;

/**
 * Class m200426_142559_sessions
 */
class m200426_142559_sessions extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('sessions', [
            'id' => $this->primaryKey(),
            'date' => $this->date(),
            'base_price' => $this->integer(),
            'movie_id' => $this->integer(),
            'hall_id' => $this->integer(),
        ]);

        $this->createIndex(
            '{{%idx-sessions_movie_id}}',
            '{{%sessions}}',
            'movie_id'
        );

        $this->addForeignKey(
            '{{%fk-sessions_movie_id}}',
            '{{%sessions}}',
            'movie_id',
            '{{%movies}}',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            '{{%idx-sessions_hall_id}}',
            '{{%sessions}}',
            'hall_id'
        );

        $this->addForeignKey(
            '{{%fk-sessions_hall_id}}',
            '{{%sessions}}',
            'hall_id',
            '{{%halls}}',
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
            '{{%fk-sessions_movie_id}}',
            '{{%sessions}}'
        );

        $this->dropIndex(
            '{{%idx-sessions_movie_id}}',
            '{{%sessions}}'
        );

        $this->dropForeignKey(
            '{{%fk-sessions_hall_id}}',
            '{{%sessions}}'
        );

        $this->dropIndex(
            '{{%idx-sessions_hall_id}}',
            '{{%sessions}}'
        );

        $this->dropTable('sessions');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200426_142559_sessions cannot be reverted.\n";

        return false;
    }
    */
}
