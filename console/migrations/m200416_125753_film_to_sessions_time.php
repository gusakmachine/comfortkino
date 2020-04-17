<?php

use yii\db\Migration;

/**
 * Class m200416_125753_film_to_sessions_time
 */
class m200416_125753_film_to_sessions_time extends Migration
{
    /**
    * {@inheritdoc}
    */
    public function safeUp()
    {
        $this->createTable('{{%film_to_sessions_time}}', [
            'id' => $this->primaryKey(),
            'film_id' => $this->integer(11),
            'time_id' => $this->integer(11),
        ]);
    }

    /**
    * {@inheritdoc}
    */
    public function safeDown()
    {
        $this->dropTable('{{%film_to_sessions_time}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200416_125753_film_to_sessions_time cannot be reverted.\n";

        return false;
    }
    */
}
