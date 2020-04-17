<?php

use yii\db\Migration;

/**
 * Class m200416_125556_film
 */
class m200416_125556_film extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%film}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255),
            'description' => $this->text(),
            'duration' => $this->time(),
            'age' => $this->tinyInteger(2)->unsigned(),
            'director' => $this->string(255),
            'poster' => $this->string(255),
            'mob_poster' => $this->string(255),
            'gallery' => $this->string(255),
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
        $this->dropTable('film');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200416_125556_film cannot be reverted.\n";

        return false;
    }
    */
}
