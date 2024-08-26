<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "image".
 *
 * @property int $id
 * @property int $picsum_id ID изображения в Picsum
 * @property bool|null $approved Изображение одобрено
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['picsum_id'], 'required'],
            [['picsum_id'], 'integer'],
            [['picsum_id'], 'unique'],
            [['approved'], 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'picsum_id' => 'ID изображения в Picsum',
            'approved' => 'Изображение одобрено',
        ];
    }
}
