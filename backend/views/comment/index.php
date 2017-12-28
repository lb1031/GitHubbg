<?php

use yii\helpers\Html;
use yii\grid\GridView;


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
            [
                'attribute'=>'content',
                'value'=>'beginning'
            ],
//            'post_id',
            [
                'attribute'=>'post_id',
                'value'=>'postName.title'
            ],
            'create_time',
//            'status',
            [
                'attribute'=>'status',
                'value'=>'postStatus.name'],
    //            'user_id',
                [
                'attribute'=>'userName',
                'label'=>'会员',
                'value'=>'getName.username'
            ],

            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {update} {delete} {approve}',
                'buttons'=>
                [
                    'approve'=>function($url,$model,$key){

                        $options=[
                            'title'=>Yii::t('yii','审核'),
            					'aria-label'=>Yii::t('yii','审核'),
            					'data-confirm'=>Yii::t('yii','你确定通过这条评论吗？'),
            					'data-method'=>'post',
            					'data-pjax'=>'0',
            						];
            				return Html::a('<span class="glyphicon glyphicon-check"></span>',$url,$options);
                    },

                ]
            ],
        ],
    ]); ?>
</div>
