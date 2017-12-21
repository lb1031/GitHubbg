<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $author
 * @property integer $tag
 * @property integer $post_status
 * @property string $create_time
 * @property string $update_time
 *
 * @property Status $postStatus
 * @property Tag $tag0
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title','content'], 'required','on'=>'create'],
            [['title'], 'required','on'=>'update'],
            [['id', 'author', 'tag', 'post_status'], 'integer'],
            [['title', 'content'], 'string'],
            [['create_time', 'update_time'], 'safe'],
            [['post_status'], 'exist', 'skipOnError' => true, 'targetClass' => Poststatus::className(), 'targetAttribute' => ['post_status' => 'id']],
            [['tag'], 'exist', 'skipOnError' => true, 'targetClass' => Tag::className(), 'targetAttribute' => ['tag' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'author' => 'Author',
            'tag' => 'Tag',
            'post_status' => 'Post Status',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }

    public function scenarios()
    {
        $arr = parent::scenarios();
        $arr1 =  [
            'create'=>['title','content'],
            'update'=>['title','content']
        ];
        return (array_merge($arr,$arr1));
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'post_status']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTag0()
    {
        return $this->hasOne(Tag::className(), ['id' => 'tag']);
    }
}
