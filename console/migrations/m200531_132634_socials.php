<?php

use yii\db\Migration;

/**
 * Class m200531_132634_socials
 */
class m200531_132634_socials extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('socials', [
            'id' => $this->primaryKey(),
            'vk' => $this->string(255),
            'facebook' => $this->string(255),
            'instagram' => $this->string(255),
            'movie_theaters_id' => $this->integer(),
        ]);

        $this->createIndex(
            '{{%idx-socials-movie-theaters_id}}',
            '{{%socials}}',
            'movie_theaters_id'
        );

        $this->addForeignKey(
            '{{%fk-socials-movie-theaters_id}}',
            '{{%socials}}',
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
            '{{%fk-socials-movie-theaters_id}}',
            '{{%socials}}'
        );

        $this->dropIndex(
            '{{%idx-socials-movie-theaters_id}}',
            '{{%socials}}'
        );

        $this->dropTable('socials');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200531_132634_socials cannot be reverted.\n";

        return false;
    }
    */
}
