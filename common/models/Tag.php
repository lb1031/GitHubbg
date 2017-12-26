<?php

namespace common\models;

use Symfony\Component\Console\EventListener\ErrorListener;
use Yii;

/**
 * This is the model class for table "tag".
 *
 * @property integer $id
 * @property string $name
 * @property integer $num
 *
 * @property Post[] $posts
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['id', 'num'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'num' => 'num',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['tag' => 'id']);
    }
    public static function string2array($tags){
        return explode(',',$tags);
    }

    public static function array2string($tags){
        return implode(',',$tags);
    }


    public static function addTag($tags){
//        var_dump($tags);die;
        if(empty($tags)) return;
        foreach ($tags as $tag) {
            $tagModel = Tag::find()->where(['name'=>$tag])->one();
            $tagCount = Tag::find()->where(['name'=>$tag])->count();
//            var_dump($tagModel,$tagCount);die;
            if($tagCount == 0){
                $aTa = new Tag();
                $aTa->name = $tag;
                $aTa->num = 1;
                $aTa->save();
            }else{
                $tagModel->num +=1;
                $tagModel->save();

            }

        }

    }


    public static function removeTag($tags){
        if(empty($tags)) return;

        foreach ($tags as $tag) {
            $tagModel = Tag::find()->where(['name'=>$tag])->one();
            $tagCount = Tag::find()->where(['name'=>$tag])->count();
           if($tagCount){
               if($tagCount == 1){
                    $tagModel->delete();
               }else{
                   $tagModel->num -=1;
               }
           }
        }
    }


    public static function updateCount($oldTag,$newTag){
//        var_dump($oldTag,$newTag);die;
        if(!empty($oldTag) || !empty($newTag)){
            $newTagArray = self::string2array($newTag);
            $oldTagArray = self::string2array($oldTag);
//            var_dump($newTagArray,$oldTagArray);
//            var_dump(array_diff($newTagArray,$oldTagArray));
//            var_dump(array_values(array_diff($newTagArray,$oldTagArray)));

//            die;
            self::addTag(array_values(array_diff($newTagArray,$oldTagArray)));
            self::removeTag(array_values(array_diff($oldTagArray,$newTagArray)));
        }
    }



}
