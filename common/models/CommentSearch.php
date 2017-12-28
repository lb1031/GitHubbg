<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Comment;

/**
 * CommentSearch represents the model behind the search form about `common\models\Comment`.
 */
class CommentSearch extends Comment
{
    public function attributes()
    {
        return array_merge(parent::attributes(),['userName']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'post_id'], 'integer'],
            [['content', 'create_time','userName','status'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Comment::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'post_id' => $this->post_id,
            'create_time' => $this->create_time,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'content', $this->content]);

        $query->join('INNER JOIN','User','Comment.user_id = User.id');
        $query->andFilterWhere(['like','User.username',$this->userName]);

        $query->join('INNER JOIN','CommentStatus','Comment.user_id = User.id');
        $query->andFilterWhere(['like','User.username',$this->userName]);

        $dataProvider->sort->attributes['userName'] = [

            'asc'=>['user.username'=>SORT_ASC],
            'desc'=>['user.username'=>SORT_DESC],
        ];

        return $dataProvider;
    }
}
