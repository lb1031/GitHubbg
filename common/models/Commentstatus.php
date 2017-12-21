<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "commentstatus".
 *
 * @property string $id
 * @property string $name
 * @property integer $count
 */
class Commentstatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'commentstatus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['count'], 'integer'],
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
            'count' => 'Count',
        ];
    }
}
