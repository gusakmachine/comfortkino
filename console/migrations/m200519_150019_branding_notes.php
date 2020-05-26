<?php

use yii\db\Migration;

/**
 * Class m200519_150019_branding_notes
 */
class m200519_150019_branding_notes extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('branding_notes', [
            'id' => $this->primaryKey(),
            'text' => $this->string(255),
            'link_text' => $this->string(255),
            'svg_image_name' => $this->string(255),
            'href' => $this->string(512),
            'movie_theaters_id' => $this->integer(),
            'end_date' => $this->date(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->createIndex(
            '{{%idx-branding_notes_movie_theaters_id}}',
            '{{%branding_notes}}',
            'movie_theaters_id'
        );

        $this->addForeignKey(
            '{{%fk-branding_notes_movie_theaters_id}}',
            '{{%branding_notes}}',
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
            '{{%fk-branding_notes_movie_theaters_id}}',
            '{{%branding_notes}}'
        );

        $this->dropIndex(
            '{{%idx-branding_notes_movie_theaters_id}}',
            '{{%branding_notes}}'
        );

        $this->dropTable('branding_notes');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200519_150019_branding_notes cannot be reverted.\n";

        return false;
    }
    */
}
