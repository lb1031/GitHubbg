<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Post;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '评论管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增评论', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
          //  ['class' => 'yii\grid\SerialColumn'],

//            'id',
            [
                'attribute'=>'id',
                'contentOptions'=>['width'=>'30px'],
            ],
//            'content:ntext',
//            [
//                'attribute'=>'content',
//                'value'=>'beginning'
//            ],
            [
                'attribute'=>'content',
                'value'=>'beginning',
//             'value'=>function($model)
//             		{
//             			$tmpStr=strip_tags($model->content);
//             			$tmpLen=mb_strlen($tmpStr);

//             			return mb_substr($tmpStr,0,20,'utf-8').(($tmpLen>20)?'...':'');
//             		}
            ],

//            'post_id',
            [
                'attribute'=>'post_id',
                'value'=>'postName.title'
            ],
            'create_time',
//            'user_id',
            [
                'attribute'=>'user_id',
                'value'=>'getName.username'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
