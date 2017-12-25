<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \common\models\Adminuser;
use \common\models\Poststatus;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'title')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'author')
        ->dropDownList(Adminuser::find()
        ->select(['name'])
        ->indexBy('id')
        ->column(),['prompt'=>'请选择作者']) ?>

    <?= $form->field($model, 'tag')->textInput() ?>

    <?= $form->field($model, 'post_status')
        ->dropDownList(Poststatus::find()
            ->select(['name','id'])
            ->indexBy('id')
            ->column(),['prompt'=>'请选择状态']) ?>

    <?= $form->field($model, 'create_time')->textInput() ?>

    <?= $form->field($model, 'update_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新建' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
