<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ads_pages}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%ads}}`
 * - `{{%pages}}`
 */
class m200511_162748_create_junction_table_for_ads_and_pages_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ads_pages}}', [
            'ads_id' => $this->integer(),
            'pages_id' => $this->integer(),
            'PRIMARY KEY(ads_id, pages_id)',
        ]);

        // creates index for column `ads_id`
        $this->createIndex(
            '{{%idx-ads_pages-ads_id}}',
            '{{%ads_pages}}',
            'ads_id'
        );

        // add foreign key for table `{{%ads}}`
        $this->addForeignKey(
            '{{%fk-ads_pages-ads_id}}',
            '{{%ads_pages}}',
            'ads_id',
            '{{%ads}}',
            'id',
            'CASCADE'
        );

        // creates index for column `pages_id`
        $this->createIndex(
            '{{%idx-ads_pages-pages_id}}',
            '{{%ads_pages}}',
            'pages_id'
        );

        // add foreign key for table `{{%pages}}`
        $this->addForeignKey(
            '{{%fk-ads_pages-pages_id}}',
            '{{%ads_pages}}',
            'pages_id',
            '{{%pages}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%ads}}`
        $this->dropForeignKey(
            '{{%fk-ads_pages-ads_id}}',
            '{{%ads_pages}}'
        );

        // drops index for column `ads_id`
        $this->dropIndex(
            '{{%idx-ads_pages-ads_id}}',
            '{{%ads_pages}}'
        );

        // drops foreign key for table `{{%pages}}`
        $this->dropForeignKey(
            '{{%fk-ads_pages-pages_id}}',
            '{{%ads_pages}}'
        );

        // drops index for column `pages_id`
        $this->dropIndex(
            '{{%idx-ads_pages-pages_id}}',
            '{{%ads_pages}}'
        );

        $this->dropTable('{{%ads_pages}}');
    }
}
