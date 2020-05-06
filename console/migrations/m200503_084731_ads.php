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
            'visibility' => $this->boolean(),
            'movie_theater_id' => $this->integer(),
            'movie_id' => $this->integer(),
            'content' => $this->text(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->createIndex(
            '{{%idx-ads-types_id}}',
            '{{%ads}}',
            'type_id'
        );

        $this->addForeignKey(
            '{{%fk-ads-ads-types}}',
            '{{%ads}}',
            'type_id',
            '{{%ads_types}}',
            'id',
            'CASCADE'
        );
        $this->createIndex(
            '{{%idx-ads-movie_id}}',
            '{{%ads}}',
            'movie_id'
        );

        $this->addForeignKey(
            '{{%fk-ads-movies}}',
            '{{%ads}}',
            'movie_id',
            '{{%movies}}',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            '{{%idx-ads-movie_theater}}',
            '{{%ads}}',
            'movie_theater_id'
        );

        $this->addForeignKey(
            '{{%fk-ads-movie_theater}}',
            '{{%ads}}',
            'movie_theater_id',
            '{{%movie_theaters}}',
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
            '{{%fk-ads-ads-types}}',
            '{{%ads}}'
        );

        $this->dropIndex(
            '{{%idx-ads-types_id}}',
            '{{%ads}}'
        );

        $this->dropForeignKey(
            '{{%fk-ads-movie}}',
            '{{%ads}}'
        );

        $this->dropIndex(
            '{{%idx-ads-movie_id}}',
            '{{%ads}}'
        );

        $this->dropForeignKey(
            '{{%fk-ads-movie_theater}}',
            '{{%ads}}'
        );

        $this->dropIndex(
            '{{%idx-ads-movie_theater}}',
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
