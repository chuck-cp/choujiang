<?php
namespace flmencrypt\encrypt;

use yii\base\Component;

class Openssl extends Component {
    public $iv;
    public $secret;

    public function decode($data){

        return openssl_decrypt($data,"DES-EDE3-CBC",$this->secret,false,$this->iv);
    }

    public function encode($data){
        return openssl_encrypt($data, "DES-EDE3-CBC",	$this->secret, false, $this->iv);
    }
}