<?php
namespace cms\core;

use yii\filters\AccessControl;
use yii\web\Controller;

class BaseController extends Controller{

    public $publicAction = [];
    public $enableCsrfValidation = false;
    public function init(){
        $this->layout = false;
    }
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['*'],
                'except' => [],
                'rules' => [
                    [
                        'actions' => $this->publicAction,
                        'allow' => true,
                        'roles' => ['?']
                    ],
                    [
                        'actions' => [],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function returnJson($code = 0,$result = [])
    {
        return json_encode([
           'code'=>$code,
           'msg' => '',
           'count' => isset($result['count']) ? $result['count'] : [],
           'data' => isset($result['date']) ? $result['date'] : []
        ]);
    }

    /**
     * 到处CSV格式文件
     * @param $data
     * @param $title
     * @param $file_name
     */
    public function Getcsv($data,$title,$file_name)
    {

        header ( 'Content-Type: application/vnd.ms-excel' );
        header ( 'Content-Disposition: attachment;filename='.$file_name );
        header ( 'Cache-Control: max-age=0' );
        $file = fopen('php://output',"a");
        $limit=1000;
        $calc=0;
        foreach ($title as $v){
            $tit[]=iconv('UTF-8', 'GBK//IGNORE',$v);
        }
        fputcsv($file,$tit);
        foreach ($data as $v){
            $calc++;
            if($limit==$calc){
                ob_flush();
                flush();
                $calc=0;
            }
            foreach ($v as $t){
                $tarr[]=iconv('UTF-8', 'GBK//IGNORE',$t);
            }
            fputcsv($file,$tarr);
            unset($tarr);
        }
        unset($list);
        fclose($file);
        exit();
    }
}