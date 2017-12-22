<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "adminuser".
 *
 * @property string $id
 * @property string $name
 * @property integer $age
 * @property string $edu
 * @property string $pwd
 * @property string $creat_time
 * @property string $update_time
 */
class Adminuser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'adminuser';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['age'], 'integer'],
            [['creat_time', 'update_time'], 'safe'],
            [['name', 'edu', 'pwd'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
//            'id' => 'ID',
            'name' => '姓名',
            'age' => '年龄',
            'edu' => '学历',
            'pwd' => '密码',
            'creat_time' => '新增时间',
            'update_time' => '修改时间',
        ];
    }
}
