<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/20
 * Time: 16:02
 */

namespace frontend\libs;
use yii\base\Action;

class TestAction extends Action
{
    public $param1 = null;
    public $param2 = null;
    public function run($get=null){
        return $this->controller->render('test',[
            'get'=>$get,
            'param1'=>$this->param1,
            'param2'=>$this->param2
        ]);
    }
}