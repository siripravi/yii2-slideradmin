<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use siripravi\slideradmin\models\Language;
use yii\helpers\Url;

?>
<div class="app-form">
   <div class="card card-primary"><?php 	
          if($src){
           echo Html::img(Url::to('@web/files/images/versions/large/'.$model->filename));
			//
		  }
			?></div>
    <?php $form = ActiveForm::begin(); ?>
    
    <ul class="nav nav-tabs">
      <?php foreach (Language::suffixList() as $suffix => $name) : ?>
                    <li class="nav-item use-max-space"><a href="#lang<?= $suffix ?>" class="nav-link <?= empty($suffix) ? ' active': '' ?>" data-bs-toggle="tab"><?= $name ?></a></li>
                <?php endforeach; ?>  
      
    </ul>

    <div class="tab-content">
        
        <?php foreach (Language::suffixList() as $suffix => $name) : ?>
             <div class="tab-pane fade<?php if (empty($suffix)) echo 'show active'; ?>" id="lang<?= $suffix ?>">
			    <?= $form->field($model, 'title' . $suffix)->textInput(['maxlength' => true]) ?>
                <!--?= $form->field($model, 'html' . $suffix)->textArea(); ?-->
				<?= $form->field($model, 'html' . $suffix)->widget(CKEditor::className(), [
                    'preset' => 'full',
                    'options' => [
                        'id' => 'pagetext' . $suffix,
                    ],
                    'clientOptions' => [
                      //  'customConfig' => '/js/ckeditor.js',
                        'language' => Yii::$app->language,
                        'allowedContent' => true,
                    ]
                ]) ?>
            </div>
        <?php endforeach; ?>

    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
