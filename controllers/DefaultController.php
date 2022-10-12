<?php

namespace siripravi\slideradmin\controllers;

use yii\web\Controller;
use yii\helpers\Html;
use siripravi\slideradmin\models\Image;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
/**
 * Default controller for the `image` module
 */
class DefaultController extends Controller {

    /**
     * Renders the index view for the module
     * @return string
     */
    
    public $images;
    public function actionIndex() {
       
            $sql = "SELECT
                        id                        
                        FROM nxt_slider
                        
						";
			//where fkValue = '$lgid' 			
            $count = 0;
            $images = Image::findBySql($sql)->all();
            $dataProvider = new ActiveDataProvider([
            'query' => Image::findBySql($sql),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        //}
        $pics = [];
       
        foreach ($images as $img) {
           
            $pics[$img->id] = $img->filename;
        }
        return $this->render('index', ['pics' => $pics,'dataProvider'=>$dataProvider]);
    }

    /**
     * Creates and renders a new version of a specific image.
     * @param integer $id the image id.
     * @param string $version the name of the image version.
     * @throws CHttpException if the requested version is not defined.
     */
    public function actionCreate($id, $version) {
        $versions = \Yii::$app->slider->versions;
        if (isset($versions[$version])) {
            $thumb = \Yii::$app->slider->createVersion($id, $version);
            $this->getImage($thumb);
           
        } else
            throw new \yii\web\HttpException(404, Img::t('error', 'Failed to create image! Version is unknown.'));
    }

    public function getImage($imagePath) {

        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
        $contentType = finfo_file($fileInfo, $imagePath);
        finfo_close($fileInfo);

        $fp = fopen($imagePath, 'r');

        header("Content-Type: " . $contentType);
        header("Content-Length: " . filesize($imagePath));

        ob_end_clean();
        fpassthru($fp);
    }

    public function actionUploadPics() {
        $pics = Array(5);
        $images = Array();
        $session = \Yii::$app->session; 
        $lgid = $session['Wizard.form'];
       		  
        if (!empty($lgid)) {
            $sql = "SELECT
                        id                        
                        FROM image
                        where name = '$lgid' ";

            $count = 0;
            $images = Image::model()->findAllBySql($sql);
        }
        
        foreach ($images as $img) {            
            $pics[$img->id] = $img->filename;
           
        }
        $this->render('/default/_adPics', array('lgid' => $lgid, 'pics' => $pics));
    }

    public function actionRemoveImage() {
        $id = isset($_POST['id']) ? $_POST['id'] : '';       
        if (\Yii::$app->image->delete($id))
            echo 'removed';
    }

    public function actionUploadPhoto($imid) {
        
        $hash = $this->request->post('hash');
        $img = UploadedFile::getInstanceByName('file');
        $savedImage = \Yii::$app->image->save($img, $hash, '','');
       
        !empty($savedImage) ? $mid = $savedImage->id : '';

        $mid = $savedImage->id;
        $this->images[] = $imid;
        $session =  \Yii::$app->session;
        $session['images'] = $this->images;
        
        if (!empty($mid))
        
            echo $mid;
        else
            echo 'removed';
    }

}