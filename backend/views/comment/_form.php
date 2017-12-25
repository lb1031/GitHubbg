<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Post;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model common\models\Comment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comment-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    <?//= $form->field($model, 'id')->textInput() ?>-->

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'post_id')
        ->dropDownList(Post::find()
        ->select(['title','id'])
        ->indexBy('id')
        ->column(),['prompt','请选择文章'])?>

    <?= $form->field($model, 'create_time')->textInput() ?>

    <?= $form->field($model, 'user_id')
        ->dropDownList(User::find()
        ->select(['username','id'])
        ->column(),['prompt'=>'评论者']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新建' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
