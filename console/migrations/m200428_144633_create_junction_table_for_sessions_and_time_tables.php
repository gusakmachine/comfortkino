<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%sessions_time}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%sessions}}`
 * - `{{%time}}`
 */
class m200428_144633_create_junction_table_for_sessions_and_time_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%sessions_time}}', [
            'sessions_id' => $this->integer(),
            'time_id' => $this->integer(),
            'PRIMARY KEY(sessions_id, time_id)',
        ]);

        // creates index for column `sessions_id`
        $this->createIndex(
            '{{%idx-sessions_time-sessions_id}}',
            '{{%sessions_time}}',
            'sessions_id'
        );

        // add foreign key for table `{{%sessions}}`
        $this->addForeignKey(
            '{{%fk-sessions_time-sessions_id}}',
            '{{%sessions_time}}',
            'sessions_id',
            '{{%sessions}}',
            'id',
            'CASCADE'
        );

        // creates index for column `time_id`
        $this->createIndex(
            '{{%idx-sessions_time-time_id}}',
            '{{%sessions_time}}',
            'time_id'
        );

        // add foreign key for table `{{%time}}`
        $this->addForeignKey(
            '{{%fk-sessions_time-time_id}}',
            '{{%sessions_time}}',
            'time_id',
            '{{%time}}',
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
            '{{%fk-sessions_time-sessions_id}}',
            '{{%sessions_time}}'
        );

        // drops index for column `sessions_id`
        $this->dropIndex(
            '{{%idx-sessions_time-sessions_id}}',
            '{{%sessions_time}}'
        );

        // drops foreign key for table `{{%time}}`
        $this->dropForeignKey(
            '{{%fk-sessions_time-time_id}}',
            '{{%sessions_time}}'
        );

        // drops index for column `time_id`
        $this->dropIndex(
            '{{%idx-sessions_time-time_id}}',
            '{{%sessions_time}}'
        );

        $this->dropTable('{{%sessions_time}}');
    }
}
