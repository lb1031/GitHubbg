<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/19
 * Time: 16:12
 */

namespace backend\libs;
use Yii;
use yii\base\Action;
use yii\base\ActionFilter;
class FilterTest extends ActionFilter
{
    public function beforeAction($action)
    {
        parent::beforeAction($action);
        echo '调用action前显示<br />';
        return false;
    }

    public function afterAction($action, $result)
    {
        parent::afterAction($action, $result);
        return $result.'调用action后显示';
    }
}