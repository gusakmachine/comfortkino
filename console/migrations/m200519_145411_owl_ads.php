<?php

use yii\db\Migration;

/**
 * Class m200519_145411_owl_ads
 */
class m200519_145411_owl_ads extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('owl_ads', [
            'id' => $this->primaryKey(),
            'subtitle' => $this->string(255),
            'title' => $this->string(255),
            'background_image_name' => $this->string(255),
            'button_text' => $this->string(255),
            'movie_theaters_id' => $this->integer(),
            'end_date' => $this->date(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->createIndex(
            '{{%idx-owl_ads_movie_theaters_id}}',
            '{{%owl_ads}}',
            'movie_theaters_id'
        );

        $this->addForeignKey(
            '{{%fk-owl_ads_movie_theaters_id}}',
            '{{%owl_ads}}',
            'movie_theaters_id',
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
            '{{%fk-owl_ads_movie_theaters_id}}',
            '{{%owl_ads}}'
        );

        $this->dropIndex(
            '{{%idx-owl_ads_movie_theaters_id}}',
            '{{%owl_ads}}'
        );

        $this->dropTable('owl_ads');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200519_145411_owl_ads cannot be reverted.\n";

        return false;
    }
    */
}
