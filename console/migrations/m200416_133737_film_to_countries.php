<?php

use yii\db\Migration;

/**
 * Class m200416_133737_film_to_countries
 */
class m200416_133737_film_to_countries extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->createTable('{{%film_to_countries}}', [
            'id' => $this->primaryKey(),
            'film_id' => $this->integer(11),
            'countries_id' => $this->integer(11),
        ]);
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropTable('{{%film_to_countries}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200416_133737_film_to_countries cannot be reverted.\n";

        return false;
    }
    */
}
