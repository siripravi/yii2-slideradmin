<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use siripravi\slideradmin\widgets\ImageWidget;
/* @var $this yii\web\View */
/* @var $model common\modules\products\models\Brand */
/* @var $form yii\widgets\ActiveForm */
?>
    <?php $form = ActiveForm::begin(); ?>
<div class="card">
<div class="card-header d-flex p-1">
<p class="card-title p-0">Fill the info </p>
</div>
 <div class="card-body">
   
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'image_count')->textInput() ?>

    <?= $form->field($model, 'enabled')->checkbox() ?>
	<?php if(!empty($key)):?>
    <!--?= ImageWidget::widget(['imageMaxCount' => $imgCount,'key'=>$key]) ?-->
    <?php endif;?>
    <div class="card-footer">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

 </div>
</div>
<?php ActiveForm::end(); ?>