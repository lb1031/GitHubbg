<?php

namespace common\models;

use Yii;
use common\models\user;

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
    private $_oldTags;
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
            [['title','content'], 'required'],
            [['id', 'author','post_status'], 'integer'],
            [['title', 'content','tag'], 'string'],
            [['create_time', 'update_time'], 'safe'],
            [['post_status'], 'exist', 'skipOnError' => true, 'targetClass' => Poststatus::className(), 'targetAttribute' => ['post_status' => 'id']],
            //此处设置 关联关系,即post表中tag中的数据必须来源于tag中的
//            [['tag'], 'exist', 'skipOnError' => true, 'targetClass' => Tag::className(), 'targetAttribute' => ['tag' => 'id']],
            [['author'], 'exist', 'skipOnError' => true, 'targetClass' => Adminuser::className(), 'targetAttribute' => ['author' => 'id']],
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
//    public function scenarios()
//    {
////        $arr = parent::scenarios();
////        $arr1 =  [
////            'create'=>['title'],
////            'update'=>['content','author']
////        ];
////        return (array_merge($arr,$arr1));
//        return [
//
//            'create'=>['title'],
//            'update'=>['content','author','tag','post_status']
//
//        ];
//    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostStatus()
    {
        return $this->hasOne(Poststatus::className(), ['id' => 'post_status']);
    }

    public function getPostAuthor()
    {
        return $this->hasOne(Adminuser::className(), ['id' => 'author']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    //这里应该是填写的,所以不需要关联
//    public function getTag0()
//    {
//        return $this->hasOne(Tag::className(), ['id' => 'tag']);
//    }

//    public function beforeSave($insert)
//    {
//         parent::beforeSave($insert);
//        var_dump($this,$_POST);die;
//    }

        public function afterFind()
        {
            parent::afterFind();
            $this->_oldTags = $this->tag;
//            var_dump($this->_oldTags);die;
        }

        public function afterSave($insert, $changedAttributes)
        {
            parent::afterSave($insert, $changedAttributes);

            Tag::updateCount($this->_oldTags,$this->tag);
        }

        public function afterDelete()
        {
            parent::afterDelete();
            
            Tag::updateCount($this->tag,'');
        }

        public function getBeginning($length=10){

            $tmpStr = strip_tags($this->title);
            $tmpLen = mb_strlen($tmpStr);

            $tmpStr = mb_substr($tmpStr,0,$length,'utf-8');
            return $tmpStr.($tmpLen>$length?'.....':'');
        }

        public function beforeSave($insert)
        {
           if(parent::beforeSave($insert)){
                if($insert){
                    $this->update_time = date('Y-m-d H:i:s',time());
                    $this->create_time = date('Y-m-d H:i:s',time());
                }else{
                    $this->update_time = date('Y-m-d H:i:s',time());
                }
                return true;
           }
           return false;
        }
}
