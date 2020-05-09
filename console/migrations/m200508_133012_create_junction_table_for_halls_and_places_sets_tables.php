<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%halls_places_sets}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%halls}}`
 * - `{{%places_sets}}`
 */
class m200508_133012_create_junction_table_for_halls_and_places_sets_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%halls_places_sets}}', [
            'halls_id' => $this->integer(),
            'places_sets_id' => $this->integer(),
            'PRIMARY KEY(halls_id, places_sets_id)',
        ]);

        // creates index for column `halls_id`
        $this->createIndex(
            '{{%idx-halls_places_sets-halls_id}}',
            '{{%halls_places_sets}}',
            'halls_id'
        );

        // add foreign key for table `{{%halls}}`
        $this->addForeignKey(
            '{{%fk-halls_places_sets-halls_id}}',
            '{{%halls_places_sets}}',
            'halls_id',
            '{{%halls}}',
            'id',
            'CASCADE'
        );

        // creates index for column `places_sets_id`
        $this->createIndex(
            '{{%idx-halls_places_sets-places_sets_id}}',
            '{{%halls_places_sets}}',
            'places_sets_id'
        );

        // add foreign key for table `{{%places_sets}}`
        $this->addForeignKey(
            '{{%fk-halls_places_sets-places_sets_id}}',
            '{{%halls_places_sets}}',
            'places_sets_id',
            '{{%places_sets}}',
            'set_id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%halls}}`
        $this->dropForeignKey(
            '{{%fk-halls_places_sets-halls_id}}',
            '{{%halls_places_sets}}'
        );

        // drops index for column `halls_id`
        $this->dropIndex(
            '{{%idx-halls_places_sets-halls_id}}',
            '{{%halls_places_sets}}'
        );

        // drops foreign key for table `{{%places_sets}}`
        $this->dropForeignKey(
            '{{%fk-halls_places_sets-places_sets_id}}',
            '{{%halls_places_sets}}'
        );

        // drops index for column `places_sets_id`
        $this->dropIndex(
            '{{%idx-halls_places_sets-places_sets_id}}',
            '{{%halls_places_sets}}'
        );

        $this->dropTable('{{%halls_places_sets}}');
    }
}
