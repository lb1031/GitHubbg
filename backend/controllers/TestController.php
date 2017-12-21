<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/19
 * Time: 16:19
 */

namespace backend\controllers;


use yii\base\Controller;

class TestController extends Controller
{
    public function behaviors()
    {
        parent::behaviors();
        return [
            'test'=>[
                'class'=>'backend\libs\FilterTest'
            ]
        ];
    }
    public function actionFilter(){
        return '当前action显示<br />';
    }
}