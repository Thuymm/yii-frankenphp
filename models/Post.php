<?php

namespace app\models;

use app\common\behaviors\PrimaryKeyBehavior;
use Yii;

/**
 * This is the model class for table "post".
 *
 * @property string $id
 * @property string|null $title
 * @property string|null $body
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['body'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['id'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'body' => 'Body',
        ];
    }

    public function behaviors()
    {
        return [
            PrimaryKeyBehavior::class,
        ];
    }
}
