<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%movies_directors}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%movies}}`
 * - `{{%directors}}`
 */
class m200503_075528_create_junction_table_for_movies_and_directors_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%movies_directors}}', [
            'movies_id' => $this->integer(),
            'directors_id' => $this->integer(),
            'PRIMARY KEY(movies_id, directors_id)',
        ]);

        // creates index for column `movies_id`
        $this->createIndex(
            '{{%idx-movies_directors-movies_id}}',
            '{{%movies_directors}}',
            'movies_id'
        );

        // add foreign key for table `{{%movies}}`
        $this->addForeignKey(
            '{{%fk-movies_directors-movies_id}}',
            '{{%movies_directors}}',
            'movies_id',
            '{{%movies}}',
            'id',
            'CASCADE'
        );

        // creates index for column `directors_id`
        $this->createIndex(
            '{{%idx-movies_directors-directors_id}}',
            '{{%movies_directors}}',
            'directors_id'
        );

        // add foreign key for table `{{%directors}}`
        $this->addForeignKey(
            '{{%fk-movies_directors-directors_id}}',
            '{{%movies_directors}}',
            'directors_id',
            '{{%directors}}',
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
            '{{%fk-movies_directors-movies_id}}',
            '{{%movies_directors}}'
        );

        // drops index for column `movies_id`
        $this->dropIndex(
            '{{%idx-movies_directors-movies_id}}',
            '{{%movies_directors}}'
        );

        // drops foreign key for table `{{%directors}}`
        $this->dropForeignKey(
            '{{%fk-movies_directors-directors_id}}',
            '{{%movies_directors}}'
        );

        // drops index for column `directors_id`
        $this->dropIndex(
            '{{%idx-movies_directors-directors_id}}',
            '{{%movies_directors}}'
        );

        $this->dropTable('{{%movies_directors}}');
    }
}
