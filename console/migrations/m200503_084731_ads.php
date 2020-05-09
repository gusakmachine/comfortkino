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
            'render_file_name' => $this->string(255),
            'page_pos' => $this->integer(),
            'movie_theater_id' => $this->integer(),
            'visibility' => $this->boolean(),
            'json_content' => $this->json(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

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
