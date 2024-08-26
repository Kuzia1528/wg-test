<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%image}}`.
 */
class m240826_020552_create_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        if ($this->db->getTableSchema('{{%image}}') !== null) {
            $this->dropTable('{{%image}}');
        }
        $this->createTable('{{%image}}', [
            'id' => $this->primaryKey(),
            'picsum_id' => $this->integer()->notNull()->comment('ID изображения в Picsum'),
            'approved' => $this->boolean()->defaultValue(false)->comment('Изображение одобрено'),
        ]);

        $this->createIndex(
            'idx-image-picsum_id',
            'image',
            'picsum_id',
            true
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%image}}');
    }
}
