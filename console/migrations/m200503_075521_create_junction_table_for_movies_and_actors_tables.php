<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%movies_actors}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%movies}}`
 * - `{{%actors}}`
 */
class m200503_075521_create_junction_table_for_movies_and_actors_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%movies_actors}}', [
            'movies_id' => $this->integer(),
            'actors_id' => $this->integer(),
            'PRIMARY KEY(movies_id, actors_id)',
        ]);

        // creates index for column `movies_id`
        $this->createIndex(
            '{{%idx-movies_actors-movies_id}}',
            '{{%movies_actors}}',
            'movies_id'
        );

        // add foreign key for table `{{%movies}}`
        $this->addForeignKey(
            '{{%fk-movies_actors-movies_id}}',
            '{{%movies_actors}}',
            'movies_id',
            '{{%movies}}',
            'id',
            'CASCADE'
        );

        // creates index for column `actors_id`
        $this->createIndex(
            '{{%idx-movies_actors-actors_id}}',
            '{{%movies_actors}}',
            'actors_id'
        );

        // add foreign key for table `{{%actors}}`
        $this->addForeignKey(
            '{{%fk-movies_actors-actors_id}}',
            '{{%movies_actors}}',
            'actors_id',
            '{{%actors}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%movies}}`
        $this->dropForeignKey(
            '{{%fk-movies_actors-movies_id}}',
            '{{%movies_actors}}'
        );

        // drops index for column `movies_id`
        $this->dropIndex(
            '{{%idx-movies_actors-movies_id}}',
            '{{%movies_actors}}'
        );

        // drops foreign key for table `{{%actors}}`
        $this->dropForeignKey(
            '{{%fk-movies_actors-actors_id}}',
            '{{%movies_actors}}'
        );

        // drops index for column `actors_id`
        $this->dropIndex(
            '{{%idx-movies_actors-actors_id}}',
            '{{%movies_actors}}'
        );

        $this->dropTable('{{%movies_actors}}');
    }
}
