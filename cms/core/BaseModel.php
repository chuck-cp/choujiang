<?php

namespace cms\core;


use yii\db\ActiveRecord;

class BaseModel extends ActiveRecord
{
    public function reducePage()
    {
        $page = (int)\Yii::$app->request->get('page');
        if(empty($page)) {
            $page = 1;
        }
        $page--;
        $limit = (int)\Yii::$app->request->get('limit');
        if(empty($limit)) {
            $limit = 20;
        }

        return [
            'offset' => $page * $limit,
            'limit' => $limit
        ];
    }
}
