<?php

use yii\db\Migration;

/**
 * Class m200426_152318_halls_places
 */
class m200426_142840_create_junction_table_for_halls_and_places_sets_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('halls_places', [
            'hall_id' => $this->integer(),
            'set_id' => $this->integer(),
        ]);

        $this->createIndex(
            '{{%idx-halls_places-hall_id}}',
            '{{%halls_places}}',
            'hall_id'
        );
        $this->addForeignKey(
            '{{%fk-halls_places-hall_id}}',
            '{{%halls_places}}',
            'hall_id',
            '{{%halls}}',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            '{{%idx-halls_places-set_id}}',
            '{{%halls_places}}',
            'set_id'
        );
        $this->addForeignKey(
            '{{%fk-halls_places-set_id}}',
            '{{%halls_places}}',
            'set_id',
            '{{%places_sets}}',
            'set_id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            '{{%fk-halls_places-hall_id}}',
            '{{%halls_places}}'
        );

        $this->dropIndex(
            '{{%idx-halls_places-hall_id}}',
            '{{%halls_places}}'
        );

        $this->dropForeignKey(
            '{{%fk-halls_places-set_id}}',
            '{{%halls_places}}'
        );

        $this->dropIndex(
            '{{%idx-halls_places-set_id}}',
            '{{%halls_places}}'
        );

        $this->dropTable('{{%movies_countries}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200426_152318_halls_places cannot be reverted.\n";

        return false;
    }
    */
}
