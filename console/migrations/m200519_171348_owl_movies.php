<?php

use yii\db\Migration;

/**
 * Class m200519_171348_owl_movies
 */
class m200519_171348_owl_movies extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('owl_movies', [
            'id' => $this->primaryKey(),
            'movie_id' => $this->integer(),
            'movie_theaters_id' => $this->integer(),
            'end_date' => $this->date(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->createIndex(
            '{{%idx-owl_movies_movie_id}}',
            '{{%owl_movies}}',
            'movie_id'
        );

        $this->addForeignKey(
            '{{%fk-owl_movies_movie_id}}',
            '{{%owl_movies}}',
            'movie_id',
            '{{%movies}}',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            '{{%idx-owl_movies_movie_theaters_id}}',
            '{{%owl_movies}}',
            'movie_theaters_id'
        );

        $this->addForeignKey(
            '{{%fk-owl_movies_movie_theaters_id}}',
            '{{%owl_movies}}',
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
            '{{%fk-owl_movies_movie_id}}',
            '{{%owl_movies}}'
        );

        $this->dropIndex(
            '{{%idx-owl_movies_movie_id}}',
            '{{%owl_movies}}'
        );

        $this->dropForeignKey(
            '{{%fk-owl_movies_movie_theaters_id}}',
            '{{%owl_movies}}'
        );

        $this->dropIndex(
            '{{%idx-owl_movies_movie_theaters_id}}',
            '{{%owl_movies}}'
        );

        $this->dropTable('owl_movies');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200519_171348_owl_movies cannot be reverted.\n";

        return false;
    }
    */
}
