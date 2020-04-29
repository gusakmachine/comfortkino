<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%movies_countries}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%movies}}`
 * - `{{%countries}}`
 */
class m200426_142832_create_junction_table_for_movies_and_countries_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%movies_countries}}', [
            'movies_id' => $this->integer(),
            'countries_id' => $this->integer(),
            'PRIMARY KEY(movies_id, countries_id)',
        ]);

        // creates index for column `movies_id`
        $this->createIndex(
            '{{%idx-movies_countries-movies_id}}',
            '{{%movies_countries}}',
            'movies_id'
        );

        // add foreign key for table `{{%movies}}`
        $this->addForeignKey(
            '{{%fk-movies_countries-movies_id}}',
            '{{%movies_countries}}',
            'movies_id',
            '{{%movies}}',
            'id',
            'CASCADE'
        );

        // creates index for column `countries_id`
        $this->createIndex(
            '{{%idx-movies_countries-countries_id}}',
            '{{%movies_countries}}',
            'countries_id'
        );

        // add foreign key for table `{{%countries}}`
        $this->addForeignKey(
            '{{%fk-movies_countries-countries_id}}',
            '{{%movies_countries}}',
            'countries_id',
            '{{%countries}}',
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
            '{{%fk-movies_countries-movies_id}}',
            '{{%movies_countries}}'
        );

        // drops index for column `movies_id`
        $this->dropIndex(
            '{{%idx-movies_countries-movies_id}}',
            '{{%movies_countries}}'
        );

        // drops foreign key for table `{{%countries}}`
        $this->dropForeignKey(
            '{{%fk-movies_countries-countries_id}}',
            '{{%movies_countries}}'
        );

        // drops index for column `countries_id`
        $this->dropIndex(
            '{{%idx-movies_countries-countries_id}}',
            '{{%movies_countries}}'
        );

        $this->dropTable('{{%movies_countries}}');
    }
}
