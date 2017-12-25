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
            [['title'], 'required','on'=>'create'],
            [['content'], 'required','on'=>'update'],
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
            'title' => '标题',
            'content' => '内容',
            'author' => '作者',
            'tag' => '标签',
            'post_status' => '文章状态',
            'create_time' => '创建时间',
            'update_time' => '修改时间',
        ];
    }

    //只用此中定义好的数据才会在对应场景被保存下来,且此中定义的数据可以不同于rules()中定义的数据
    public function scenarios()
    {
//        $arr = parent::scenarios();
//        $arr1 =  [
//            'create'=>['title'],
//            'update'=>['content','author']
//        ];
//        return (array_merge($arr,$arr1));
        return [

            'create'=>['title'],
            'update'=>['content','author','tag','post_status']

        ];
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

//    public function beforeSave($insert)
//    {
//         parent::beforeSave($insert);
//        var_dump($this,$_POST);die;
//    }
}
