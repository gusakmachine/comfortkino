<?php

use yii\db\Migration;

/**
 * Class m200531_132647_phone_numbers
 */
class m200531_132647_phone_numbers extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('phone_numbers', [
            'id' => $this->primaryKey(),
            'phone' => $this->string(255),
            'movie_theaters_id' => $this->integer(),
        ]);

        $this->createIndex(
            '{{%idx-phone-numbers-movie-theaters_id}}',
            '{{%phone_numbers}}',
            'movie_theaters_id'
        );

        $this->addForeignKey(
            '{{%fk-phone-numbers-movie-theaters_id}}',
            '{{%phone_numbers}}',
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
            '{{%fk-phone-numbers-movie-theaters_id}}',
            '{{%phone_numbers}}'
        );

        $this->dropIndex(
            '{{%idx-phone-numbers-movie-theaters_id}}',
            '{{%phone_numbers}}'
        );

        $this->dropTable('phone_numbers');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200531_132647_phone_numbers cannot be reverted.\n";

        return false;
    }
    */
}
