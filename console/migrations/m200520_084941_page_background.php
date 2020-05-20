<?php

use yii\db\Migration;

/**
 * Class m200520_084941_page_background
 */
class m200520_084941_page_background extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('page_background', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'background_image_name' => $this->string(255),
            'movie_theaters_id' => $this->integer(),
            'end_date' => $this->date(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->createIndex(
            '{{%idx-page_background_movie_theaters_id}}',
            '{{%page_background}}',
            'movie_theaters_id'
        );

        $this->addForeignKey(
            '{{%fk-page_background_movie_theaters_id}}',
            '{{%page_background}}',
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
            '{{%fk-page_background_movie_theaters_id}}',
            '{{%page_background}}'
        );

        $this->dropIndex(
            '{{%idx-page_background_movie_theaters_id}}',
            '{{%page_background}}'
        );

        $this->dropTable('page_background');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200520_084941_page_background cannot be reverted.\n";

        return false;
    }
    */
}
