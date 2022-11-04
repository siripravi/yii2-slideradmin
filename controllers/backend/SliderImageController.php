<?php

namespace siripravi\slideradmin\controllers\backend;
use yii;
use yii\web\Controller;
use yii\helpers\Html;
use siripravi\slideradmin\models\SliderImage;
use siripravi\slideradmin\models\Slider;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;

/**
 * Default controller for the `image` module
 */
class SliderImageController extends Controller {

    /**
     * Renders the index view for the module
     * @return string
     */
    
    public $images;
    public function actionIndex($id) {
		$image = new SliderImage();
		$image->scenario="slide";
		if(Yii::$app->request->post()){
			$image->imageFile = UploadedFile::getInstance($image, 'imageFile');		
			$hash = $this->request->post('hash');
            $slider_id = $this->request->post('slider_id');
			$savedImage = \Yii::$app->controller
			->module->slider->save($image->imageFile, $hash, '','',$slider_id);
			$path = \Yii::$app->controller->module->slider
			->createVersion($savedImage->id, "small");			
			$image = new SliderImage();
		    $image->scenario="slide";			
		}
		
		$slider = Slider::findOne($id);
        $dataProvider = new ActiveDataProvider([
            'query' => SliderImage::find()->andWhere(['slider_id' => $id]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider, //'key'=>$slider->id, 
			'imgCount'=>$slider->image_count,'image' => $image
        ]);		
        
    }

    /**
     * Displays a single Block model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
	
    /**
     * Updates an existing Brand model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
		$model = $this->findModelMulti($id);
        $src =$model->render($model->filename,"large",[]);
		if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $path = \Yii::$app->controller->module->slider
			->createVersion($model->id, "large");
			if($path){
				$src = $model->render($model->filename,"large",[]);
			}			
           	Yii::$app->session->setFlash('success', Yii::t('app', 'Information added successfully.'));
            return $this->redirect(['index','id'=>$model->slider_id]);
		}
		
        return $this->render('update', [
            'model' => $model, 'src' => $src
        ]);
    }
	
    public function actionRemoveImage() {
        $id = isset($_POST['id']) ? $_POST['id'] : '';       
        if (\Yii::$app->controller->module->slider->delete($id))
            echo 'removed';
    }
	/**
     * Finds the  model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return  the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SliderImage::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
   protected function findImages($id)
    {
        if (($models = SliderImage::find(['slider_id' => $id])->all()) !== null) {
            return $models;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	/**
     * Deletes an existing  model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
		$this->findModel($id)->delete();
		if (Yii::$app->request->isAjax) {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return ['success' => true];
    }
        return $this->redirect(Yii::$app->request->referrer);
    }
	
	/**
     * Finds the  model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return |\yii\db\ActiveRecord
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelMulti($id)
    {
		if (($model = SliderImage::find()->where(['id' => $id])->multilingual()->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }
}