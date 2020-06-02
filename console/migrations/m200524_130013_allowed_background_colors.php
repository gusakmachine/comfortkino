<?php

use yii\db\Migration;

/**
 * Class m200524_130013_allowed_background_colors
 */
class m200524_130013_allowed_background_colors extends Migration
{
    /**
     * {@inheritdoc}
     */
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('allowed_background_colors', [
            'id' => $this->primaryKey(),
            'color_id' => $this->integer(255),
        ]);

        $this->createIndex(
            '{{%idx-allowed_background_colors_color_id}}',
            '{{%allowed_background_colors}}',
            'color_id'
        );

        $this->addForeignKey(
            '{{%fk-allowed_background_colors_colors}}',
            '{{%allowed_background_colors}}',
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
        $this->dropForeignKey(
            '{{%fk-allowed_background_colors_colors}}',
            '{{%owl_movies}}'
        );

        $this->dropIndex(
            '{{%idx-allowed_background_colors_color_id}}',
            '{{%owl_movies}}'
        );

        $this->dropTable('allowed_background_colors');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200524_130013_allowed_background_colors cannot be reverted.\n";

        return false;
    }
    */
}
