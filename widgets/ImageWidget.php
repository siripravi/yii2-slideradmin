<?php

// your_app/votewidget/VoteWidget.php

namespace siripravi\slideradmin\widgets;

use siripravi\slideradmin\widgets\assets\ImageWidgetAsset;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use siripravi\slideradmin\models\Image;
use yii\helpers\Url;
use yii\base\Security;
use ParagonIE\ConstantTime\Base32;

class ImageWidget extends Widget {

    private $id;
	
    public $key;
	public $hash;
    public $imageMaxCount;
    private $imageData;
    public $uploadUrl;
    public $sessionKey = 'gallery.key';
	
    public function init() {
        parent::init();
		$session = \Yii::$app->session;
		$this->hash = !empty($session[$this->sessionKey])? $session[$this->sessionKey] : $this->generateSecret();
		$session[$this->sessionKey] = $this->hash;
		//echo ":HASH: ".$this->hash. "\n";
        $this->imageData = Array($this->imageMaxCount);       
        $this->uploadUrl = Url::to(['/slider/default/upload-photo', 'imid' => $this->hash]);       
    }

    public function getImages() {   
        $key = ($this->key)? $this->key : "";		 
        $sql = "SELECT
                        id, hash, filename                       
                        FROM nxt_slider
                        where hash = '$this->hash'";
        
        $images = Image::findBySql($sql)->all();
        $data = ArrayHelper::toArray($images, [
                    'siripravi\slideradmin\models\Image' => [
                        'id',
                        'hash',
                        'filename',                      
                        'createTime' => 'created',                       
                        'imageSrc' => function ($image) {
                            return Url::to(['/slider/default/create', 'id' => $image->id, 'version' => 'small']);
                        },
                    ],
        ]);

        return $data;
    }

    public function run() {
        ImageWidgetAsset::register($this->getView());
        $this->imageData = $this->getImages($this->key);       
        return $this->render('imagewidget', ['images' => $this->imageData, 'uploadUrl' => $this->uploadUrl,'hash' => $this->hash]);
    }

    public function getViewPath() {
        return '@app/modules/slider/views/';
    }
	
	public function generateSecret($length = 20)
 {
     $security = new Security();
     $full = Base32::encode($security->generateRandomString($length));
     return substr($full, 0, $length);
 }

}

?>