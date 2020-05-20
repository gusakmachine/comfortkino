<?php

use yii\db\Migration;

/**
 * Class m200519_150032_notes
 */
class m200519_150032_notes extends Migration
{
    public function safeUp()
    {
        $this->createTable('notes', [
            'id' => $this->primaryKey(),
            'text' => $this->string(255),
            'svg_image_name' => $this->string(255),
            'background_color' => $this->string(255),
            'movie_theaters_id' => $this->integer(),
            'end_date' => $this->date(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->createIndex(
            '{{%idx-notes_movie_theaters_id}}',
            '{{%notes}}',
            'movie_theaters_id'
        );

        $this->addForeignKey(
            '{{%fk-notes_movie_theaters_id}}',
            '{{%notes}}',
            'movie_theaters_id',
            '{{%movie_theaters}}',
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
            '{{%fk-notes_movie_theaters_id}}',
            '{{%notes}}'
        );

        $this->dropIndex(
            '{{%idx-notes_movie_theaters_id}}',
            '{{%notes}}'
        );

        $this->dropTable('notes');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200519_150032_notes cannot be reverted.\n";

        return false;
    }
    */
}
