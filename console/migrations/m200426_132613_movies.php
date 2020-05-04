<?php

use yii\db\Migration;

/**
 * Class m200426_142613_movies
 */
class m200426_132613_movies extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('movies', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255),
            'description' => $this->text(),
            'duration' => $this->time(),
            'age' => $this->tinyInteger(2)->unsigned(),
            'poster' => $this->string(255),
            'mob_poster' => $this->string(255),
            'trailer' => $this->string(255),
            'release_date' => $this->date(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('movies');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200426_142613_movies cannot be reverted.\n";

        return false;
    }
    */
}
