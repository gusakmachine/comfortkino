<?php

use yii\db\Migration;

/**
 * Class m200416_125738_film_to_city
 */
class m200416_125738_film_to_city extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%film_to_city}}', [
            'id' => $this->primaryKey(),
            'film_id' => $this->integer(11),
            'city_id' => $this->integer(11),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%film_to_city}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200416_125738_film_to_city cannot be reverted.\n";

        return false;
    }
    */
}
