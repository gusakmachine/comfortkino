<?php

use yii\db\Migration;

/**
 * Class m200426_142545_movie_theaters
 */
class m200426_142545_movie_theaters extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('movie_theaters', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'address' => $this->string(255),
            'google-map-img' => $this->string(255),
            'google-map-link' => $this->string(512),
            'subdomain_name' => $this->string(255),
            'city_id' => $this->integer(),
        ]);

        $this->createIndex(
            '{{%idx-movie_theaters_city_id}}',
            '{{%movie_theaters}}',
            'city_id'
        );

        $this->addForeignKey(
            '{{%fk-movie_theaters-city_id}}',
            '{{%movie_theaters}}',
            'city_id',
            '{{%cities}}',
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
            '{{%fk-movie_theaters-city_id}}',
            '{{%movie_theaters}}'
        );

        $this->dropIndex(
            '{{%idx-movie_theaters_city_id}}',
            '{{%movie_theaters}}'
        );

        $this->dropTable('movie_theaters');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200426_142545_movie_theaters cannot be reverted.\n";

        return false;
    }
    */
}
