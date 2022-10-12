<?php

use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;

?>

<?php  
    // $key = (isset($pics[$count])) ? $pics[$count]['id'] : '';
    $imShow = (isset($key)) ? 'block;' : 'none;';
    $psShow = (!isset($key)) ? 'block;' : 'none;';
?>
     <div class="preview-image preview-show-1">
         <div class="image-cancel" data-no="3">
                
          
         </div>
       <div class="image-zone"> 
            <?=Html::img($model->id, ['alt' =>"", 'id' => 'pimg-' . ($index + 1)]);    ?>
    
        </div>
    
       <div class="tools-edit-image">
          <a  id="<?= $key;  ?>" title="Remove this picture" class="delete">X
       </a>      
       </div>
      
     </div>            
  
    