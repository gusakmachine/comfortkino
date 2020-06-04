<?php

use yii\db\Migration;

/**
 * Class m200501_170559_gallery
 */
class m200501_170559_gallery extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('gallery', [
            'id' => $this->primaryKey(),
            'image_name' => $this->string(255),
            'movies_id' => $this->integer(),
        ]);

        $this->createIndex(
            '{{%idx-gallery-movies_id}}',
            '{{%gallery}}',
            'movies_id'
        );

        $this->addForeignKey(
            '{{%fk-gallery_id}}',
            '{{%gallery}}',
            'movies_id',
            '{{%movies}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%movies}}`
        $this->dropForeignKey(
            '{{%fk-gallery_id}}',
            '{{%gallery}}'
        );

        // drops index for column `movies_id`
        $this->dropIndex(
            '{{%idx-gallery-movies_id}}',
            '{{%gallery}}'
        );

        $this->dropTable('gallery');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200501_170559_gallery cannot be reverted.\n";

        return false;
    }
    */
}
