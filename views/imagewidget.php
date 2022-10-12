<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;
use yii\data\ArrayDataProvider;

?>
<style type="text/css">
   input[type=file] {
	cursor: pointer;	
}
</style>
 <?php 
       // echo 'HASH :'.$hash;
       $count = count($images);
      // echo $count;
       $i = 0;
       while($i < $count){  ?>
<div class="col-xs-6 col-md-3">
            <div class="thumbnail">
               <div class="tools-edit-image">
          <a  id="<?= $images[$i]['id'];  ?>" title="Remove this picture" class="delete">X
       </a>      
       </div>
                  <?=Html::img($images[$i]['imageSrc'], ['alt' =>"", 'id' => 'pimg-' . ($i + 1),'class'=>'img-fullsize']);    ?>
    
                <div class="caption">
                    <p class="flex-text"><?= $images[$i]['filename'];  ?></p>
                </div>
                
            </div>
        </div> <!-- /.col-xs-6.col-md-3 -->
<?php 
    
       $i++;
       }  ?>
        <div class="col-xs-6 col-md-3">
              <div class="th_wrapper">
            <div class="thumbnail">
                <div id="div_image_select_<?php echo $count ?>" class="image_select" style="">
                    <a id="btn_change_image_<?php echo ($count + 1); ?>" class="image-select-edit rel" style="" title="click to choose a picture">
            
                            <i id="image-select-add-<?php echo ($count + 1); ?>" class="" ></i>
                            <?php
                            $form = ActiveForm::begin([
                                        'id' => 'frm_img_select' . $count,
                                        'action' => $uploadUrl,
                                        'options' => ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data'],
                                    ])
                            ?>       
                            <input type="hidden" name="_csrf" id="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>">							
                            <input type="hidden" name="pict" value="<?php echo ($count + 1); ?>"/>
							<?= Html::hiddenInput('hash',$hash); ?>
                        <?php ActiveForm::end() ?>
                  
                    </a>
                </div>
            </div> 
            </div>
        </div> 
    