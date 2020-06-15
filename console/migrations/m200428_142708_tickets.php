<?php

use yii\db\Migration;

/**
 * Class m200426_142606_tickets
 */
class m200428_142708_tickets extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tickets', [
            'id' => $this->primaryKey(),
            'customer_phone' => $this->string(255),
            'status' => $this->integer(),
            'sessions_id' => $this->integer(),
            'place_id' => $this->integer(),
            'movie_id' => $this->integer(),
            'hall_id' => $this->integer(),
            'movie_theaters_id' => $this->integer(),
            'city_id' => $this->integer(),
            'times_id' => $this->integer(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->createIndex(
            '{{%idx-tickets-sessions_id}}',
            '{{%tickets}}',
            'sessions_id'
        );
        $this->addForeignKey(
            '{{%fk-tickets-sessions_id}}',
            '{{%tickets}}',
            'sessions_id',
            '{{%sessions}}',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            '{{%idx-tickets-place_id}}',
            '{{%tickets}}',
            'place_id'
        );
        $this->addForeignKey(
            '{{%fk-tickets-place_id}}',
            '{{%tickets}}',
            'place_id',
            '{{%places_sets}}',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            '{{%idx-tickets-movie_id}}',
            '{{%tickets}}',
            'movie_id'
        );
        $this->addForeignKey(
            '{{%fk-tickets-movie_id}}',
            '{{%tickets}}',
            'movie_id',
            '{{%movies}}',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            '{{%idx-tickets-hall_id}}',
            '{{%tickets}}',
            'hall_id'
        );
        $this->addForeignKey(
            '{{%fk-tickets-hall_id}}',
            '{{%tickets}}',
            'hall_id',
            '{{%halls}}',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            '{{%idx-tickets-movie_theaters_id}}',
            '{{%tickets}}',
            'movie_theaters_id'
        );
        $this->addForeignKey(
            '{{%fk-tickets-movie_theaters_id}}',
            '{{%tickets}}',
            'movie_theaters_id',
            '{{%movie_theaters}}',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            '{{%idx-tickets-city_id}}',
            '{{%tickets}}',
            'city_id'
        );
        $this->addForeignKey(
            '{{%fk-tickets-city_id}}',
            '{{%tickets}}',
            'city_id',
            '{{%cities}}',
            'id',
            'CASCADE'
        );
        $this->createIndex(
            '{{%idx-tickets-times_id}}',
            '{{%tickets}}',
            'times_id'
        );
        $this->addForeignKey(
            '{{%fk-tickets-times_id}}',
            '{{%tickets}}',
            'times_id',
            '{{%times}}',
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
            '{{%fk-tickets-times_id}}',
            '{{%tickets}}'
        );
        $this->dropIndex(
            '{{%idx-tickets-times_id}}',
            '{{%tickets}}'
        );

        $this->dropForeignKey(
            '{{%fk-tickets-movie_theaters_id}}',
            '{{%tickets}}'
        );
        $this->dropIndex(
            '{{%idx-tickets-movie_theaters_id}}',
            '{{%tickets}}'
        );

        $this->dropForeignKey(
            '{{%fk-tickets-city_id}}',
            '{{%tickets}}'
        );
        $this->dropIndex(
            '{{%idx-tickets-city_id}}',
            '{{%tickets}}'
        );

        $this->dropForeignKey(
            '{{%fk-tickets-hall_id}}',
            '{{%tickets}}'
        );
        $this->dropIndex(
            '{{%idx-tickets-hall_id}}',
            '{{%tickets}}'
        );

        $this->dropForeignKey(
            '{{%fk-tickets-movie_id}}',
            '{{%tickets}}'
        );
        $this->dropIndex(
            '{{%idx-tickets-movie_id}}',
            '{{%tickets}}'
        );

        $this->dropForeignKey(
            '{{%fk-tickets-place_id}}',
            '{{%tickets}}'
        );
        $this->dropIndex(
            '{{%idx-tickets-place_id}}',
            '{{%tickets}}'
        );

        $this->dropForeignKey(
            '{{%fk-tickets-sessions_id}}',
            '{{%tickets}}'
        );
        $this->dropIndex(
            '{{%idx-tickets-sessions_id}}',
            '{{%tickets}}'
        );

        $this->dropTable('tickets');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200426_142606_tickets cannot be reverted.\n";

        return false;
    }
    */
}
