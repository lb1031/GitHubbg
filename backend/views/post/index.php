<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Poststatus;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '文章管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增文章', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //生成序号
            //['class' => 'yii\grid\SerialColumn'],

//            'id',
            [
                'attribute'=>'id',
                'contentOptions'=>['width'=>'30px']
            ],
            'title:ntext',
//            'content:ntext',
//            'author',
            [
                'attribute'=>'authorName',
                'label'=>'作者',
                'value'=>'postAuthor.username'
            ],

            'tag',
//             'post_status',
            [
                'attribute'=>'post_status',
                'value'=>'postStatus.name',
                'filter'=>Poststatus::find()
                ->select(['name','id'])
                ->indexBy('id')
                ->column(),
                'contentOptions'=>['width'=>'150px']
            ],
//             'create_time',
             'update_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
