<?php
use yii\helpers\Html;
use siripravi\slideradmin\widgets\ImageWidget;
use yii\helpers\Url;
use yii\widgets\ListView;
$fakedModel = (object)['title'=> 'A Product', 'image' => 'http://placehold.it/350x150'];

?>
<div class="image-default-index">
    <h1><?= $this->context->action->uniqueId ?></h1>
    <p>
        This is the view content for action "<?= $this->context->action->id ?>".
        The action belongs to the controller "<?= get_class($this->context) ?>"
        in the "<?= $this->context->module->id ?>" module.
    </p>
    <p>
        You may customize this page by editing the following file:<br>
        <code><?= __FILE__ ?></code>
    <div id="imgIds"></div>
    
        <?php /* ImageWidget::widget(['imageMaxCount' => 5, 'lgid' => $lgid, 'pics' => $pics,'uploadUrl'=>Url::to(['/image/default/upload-photo','imid'=>$lgid]),
            'images' => $pics,'imageData' => $dataProvider]) */ ?>
    
    
    
    </p>
</div>
<div class="container">
    <div class="row equal-height">
        <?= ImageWidget::widget(['imageMaxCount' => 5,'key'=>2]) ?>
    </div>
</div>

<div class="rui-2SwH7 rui-1JF_2">
    <div class="_1Hyzp rui-2SwH7 rui-1wY3r rui-3CPXI rui-3E1c2 rui-1JF_2" data-aut-id="dragAndDrop">
        <h2>Upload up to 12 photos</h2>
        <div class="_2vNUv" aria-disabled="false">
            <div class="q_7hS" data-aut-id="imagesPreview">
                <ul class="_3IhNg"></ul>
                <div class="_1SuBk _24pdo">
                    <div class="_36uzR">
                        <span class="rui-3pJ6W" role="button" tabindex="0" data-aut-id=""><i class="rui-1XUas rui-32Azx" title=""></i></span>
                        <div class="e22Bu"><span>Add photo</span></div>
                    </div>
                </div>
                <div class="_1SuBk">
                    <div class="_36uzR">
                        <span class="rui-3pJ6W" role="button" tabindex="0" data-aut-id="">
                            <i class="rui-1XUas rui-32Azx" title=""></i>
                        </span>
                    </div>
                </div>
                <div class="_1SuBk">
                    <div class="_36uzR">
                        <span class="rui-3pJ6W" role="button" tabindex="0" data-aut-id="">
                            <i class="rui-1XUas rui-32Azx" title=""></i>
                        </span>
                    </div>
                </div>
                <div class="_1SuBk">
                    <div class="_36uzR"><span class="rui-3pJ6W" role="button" tabindex="0" data-aut-id=""><i class="rui-1XUas rui-32Azx" title=""></i></span></div>
                </div>
               
            </div>
            <input accept="image/png, image/jpeg" type="file" multiple="" autocomplete="off" style="display: none;">
        </div>
        <p class="_1cQuv"><span>This field is mandatory</span></p>
    </div>
</div>