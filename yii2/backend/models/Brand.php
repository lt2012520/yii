<?php
namespace backend\models;

use yii\db\ActiveRecord;

class Brand extends ActiveRecord{
    public static function getStatusOptions($option=1){
        return[
            -1=>'删除',
            0=>'隐藏',
            1=>'正常',
        ];
        if($option){
            return[
                0=>'隐藏',
                1=>'正常',
            ];
        }
    }
}