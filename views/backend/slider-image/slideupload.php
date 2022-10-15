<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;
use yii\data\ArrayDataProvider;
use yii\widgets\Pjax;

?>

<?php yii\widgets\Pjax::begin(['id' => 'new_slide']) ?>
<div  class="image_select">
    
		<?php
            $form = ActiveForm::begin([
                'id' => 'frm_img_select',               
                'options' => [
					'class' => 'form-horizontal', 
					'enctype' => 'multipart/form-data'
				],
            ])
        ?>	
			<?= Html::hiddenInput('slider_id',Yii::$app->request->get('id',"")); ?>		
			<?= Html::hiddenInput('hash',""); ?>
			<div class="form-group">
			<?= $form->field($image, 'imageFile')->fileInput() ?>
			</div>
	 <div class="form-group">
        <?= Html::submitButton('Upload Image',['class'=>'btn btn-success']) ?>
    </div>
		<?php ActiveForm::end() ?>
	
</div>
<?php yii\widgets\Pjax::end() ?>        
