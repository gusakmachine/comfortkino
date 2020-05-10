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
            'price_id' => $this->integer(),
            'color_id' => $this->integer(),
        ]);

        $this->createIndex(
            '{{%idx-places_sets_set_id}}',
            '{{%places_sets}}',
            'set_id'
        );

        $this->createIndex(
            '{{%idx-places_sets_price_id}}',
            '{{%places_sets}}',
            'price_id'
        );

        $this->addForeignKey(
            '{{%fk-price_id}}',
            '{{%places_sets}}',
            'price_id',
            '{{%place_prices}}',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            '{{%idx-places_sets_color_id}}',
            '{{%places_sets}}',
            'color_id'
        );

        $this->addForeignKey(
            '{{%fk-color_id}}',
            '{{%places_sets}}',
            'color_id',
            '{{%colors}}',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex(
            '{{%idx-places_sets-set_id}}',
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
