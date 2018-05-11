<?php
namespace common\models;

use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * Class Post
 * @package common\models
 * @property integer $id
 * @property string $author
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property string $content
 * @property string $image
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */

class Post extends ActiveRecord {

    const STATUS_ON = 1;
    const STATUS_OFF = 0;

    /**
     * @return string
     */
    public static function tableName() {
        return '{{%posts}}';
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['author', 'title', 'slug', 'description', 'content', 'image'], 'string'],
            [['author', 'title', 'content'], 'required'],
            [['author', 'title', 'description', 'content', 'image'], 'trim'],
            ['status', 'boolean'],
            ['status', 'default', 'value' => self::STATUS_ON],
            ['status', 'in', 'range' => [self::STATUS_ON, self::STATUS_OFF]]
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'title',
            ],
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
            ],
        ];
    }
}