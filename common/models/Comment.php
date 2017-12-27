<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property integer $id
 * @property string $content
 * @property integer $post_id
 * @property string $create_time
 * @property integer $user_id
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['post_id'], 'required'],
            [['id', 'post_id', 'user_id'], 'integer'],
            [['content'], 'string'],
            [['create_time'], 'safe'],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
//            'id' => 'ID',
            'content' => '内容',
            'post_id' => '文章',
            'create_time' => '创建时间',
            'user_id' => '会员',
        ];
    }

    public function getPostName(){
        return Comment::hasOne(Post::className(),['id'=>'post_id']);
    }
    public function getGetName(){
        return Comment::hasOne(User::className(),['id'=>'user_id']);
    }

//    public function getBeginning($length=288)
//    {
//        $tmpStr = strip_tags($this->content);
//        $tmpLen = mb_strlen($tmpStr);
//
//        $tmpStr = mb_substr($tmpStr,0,$length,'utf-8');
//        return $tmpStr.($tmpLen>$length?'...':'');
//    }

    public function getBeginning($length=10)
    {
        $tmpStr = strip_tags($this->content);
        $tmpLen = mb_strlen($tmpStr);

        return mb_substr($tmpStr,0,$length,'utf-8').(($tmpLen>$length)?'...':'');
    }
}
