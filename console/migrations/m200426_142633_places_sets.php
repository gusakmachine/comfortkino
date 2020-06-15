<?php

use yii\db\Migration;

/**
 * Class m200426_142632_places_sets
 */
class m200426_142633_places_sets extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('places_sets', [
            'id' => $this->primaryKey(),
            'place' => $this->integer(),
            'row' => $this->integer(),
            'graphic_display' => $this->json(),
            'set_id' => $this->integer(),
            'price' => $this->integer(),
            'color' => $this->string(255),
        ]);

        $this->createIndex(
            '{{%idx-places_sets_set_id}}',
            '{{%places_sets}}',
            'set_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex(
            '{{%idx-places_sets_color_id}}',
            '{{%places_sets}}'
        );

        $this->dropTable('places_sets');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200426_142632_places_sets cannot be reverted.\n";

        return false;
    }
    */
}
