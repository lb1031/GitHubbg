<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Post;

/**
 * PostSearch represents the model behind the search form about `common\models\Post`.
 */
class PostSearch extends Post
{
    public function attributes()
    {
        return array_merge(parent::attributes(),['authorName']);
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'post_status'], 'integer'],
            [['title', 'content', 'create_time', 'tag','update_time','authorName'], 'safe'],
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
        $query = Post::find();

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
            'author' => $this->author,
            'tag' => $this->tag,
            'post_status' => $this->post_status,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'tag', $this->tag]);

        $query->join('INNER JOIN','Adminuser','Post.author = Adminuser.id');
        $query->andFilterWhere(['like','Adminuser.name',$this->authorName]);


        $dataProvider->sort->attributes['authorName'] =
            [
                'asc'=>['Adminuser.name'=>SORT_ASC],
                'desc'=>['Adminuser.name'=>SORT_DESC],
            ];

        return $dataProvider;
    }
}
