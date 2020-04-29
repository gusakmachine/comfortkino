<?php

use yii\db\Migration;

/**
 * Class m200426_142550_halls
 */
class m200426_142550_halls extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('halls', [
            'id' => $this->primaryKey(),
            'capacity' => $this->integer(),
            'movie_theaters_id' => $this->integer(),
        ]);

        $this->createIndex(
            '{{%idx-halls_movie_theaters_id}}',
            '{{%halls}}',
            'movie_theaters_id'
        );

        $this->addForeignKey(
            '{{%fk-halls_movie_theaters_id}}',
            '{{%halls}}',
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
            '{{%fk-halls_movie_theaters_id}}',
            '{{%halls}}'
        );

        $this->dropIndex(
            '{{%idx-halls_movie_theaters_id}}',
            '{{%halls}}'
        );

        $this->dropTable('halls');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200426_142550_halls cannot be reverted.\n";

        return false;
    }
    */
}
