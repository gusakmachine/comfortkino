<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%sessions_time_prices}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%sessions}}`
 * - `{{%time_prices}}`
 */
class m200504_135445_create_junction_table_for_sessions_and_time_prices_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%sessions_time_prices}}', [
            'sessions_id' => $this->integer(),
            'time_prices_id' => $this->integer(),
            'PRIMARY KEY(sessions_id, time_prices_id)',
        ]);

        // creates index for column `sessions_id`
        $this->createIndex(
            '{{%idx-sessions_time_prices-sessions_id}}',
            '{{%sessions_time_prices}}',
            'sessions_id'
        );

        // add foreign key for table `{{%sessions}}`
        $this->addForeignKey(
            '{{%fk-sessions_time_prices-sessions_id}}',
            '{{%sessions_time_prices}}',
            'sessions_id',
            '{{%sessions}}',
            'id',
            'CASCADE'
        );

        // creates index for column `time_prices_id`
        $this->createIndex(
            '{{%idx-sessions_time_prices-time_prices_id}}',
            '{{%sessions_time_prices}}',
            'time_prices_id'
        );

        // add foreign key for table `{{%time_prices}}`
        $this->addForeignKey(
            '{{%fk-sessions_time_prices-time_prices_id}}',
            '{{%sessions_time_prices}}',
            'time_prices_id',
            '{{%time_prices}}',
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
            '{{%fk-sessions_time_prices-sessions_id}}',
            '{{%sessions_time_prices}}'
        );

        // drops index for column `sessions_id`
        $this->dropIndex(
            '{{%idx-sessions_time_prices-sessions_id}}',
            '{{%sessions_time_prices}}'
        );

        // drops foreign key for table `{{%time_prices}}`
        $this->dropForeignKey(
            '{{%fk-sessions_time_prices-time_prices_id}}',
            '{{%sessions_time_prices}}'
        );

        // drops index for column `time_prices_id`
        $this->dropIndex(
            '{{%idx-sessions_time_prices-time_prices_id}}',
            '{{%sessions_time_prices}}'
        );

        $this->dropTable('{{%sessions_time_prices}}');
    }
}
