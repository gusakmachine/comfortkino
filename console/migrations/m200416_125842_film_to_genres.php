<?php

use yii\db\Migration;

/**
 * Class m200416_125842_film_to_genres
 */
class m200416_125842_film_to_genres extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->createTable('{{%film_to_genres}}', [
            'id' => $this->primaryKey(),
            'film_id' => $this->integer(11),
            'genre_id' => $this->integer(11),
        ]);
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropTable('{{%film_to_genres}}');
    }


/*
// Use up()/down() to run migration code without a transaction.
public function up()
{

}

public function down()
{
    echo "m200416_125842_film_to_genres cannot be reverted.\n";

    return false;
}
*/
}
