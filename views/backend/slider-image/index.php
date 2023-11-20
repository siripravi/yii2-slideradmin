<?php

use yii\helpers\Html;
use yii\grid\GridView;
use siripravi\slideradmin\widgets\ImageWidget;
use yii\helpers\Url;
use yii\widgets\Pjax;
//use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Slides');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php

$this->registerJs(
   '$("document").ready(function(){ 
		$("#new_slide").on("pjax:end", function() {
			$.pjax.reload({container:"#allslides"});  //Reload GridView
		});
		
    });'
);
?>

<div class="row">   
   
<div class="flex-column"> 
     
	<?php Pjax::begin(['id' => 'allslides']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
           // 'id',
           // 'filename',
			[ 'format' => 'raw',
			
			'value' => function ($image) {              
							return $image->render($image->filename,"small",[]);			
                    },
			],			
			//'slider_id',
           // 'enabled',
             'title',
            ['class' => 'yii\grid\ActionColumn',
			   'template' => '{update}&nbsp;&nbsp;{delete}'
			],
			
		  ],
    ]); ?>
	<?php Pjax::end() ?>
	</div>
	<div class="col-6">
	  <!--?= ImageWidget::widget(['imageMaxCount' => $imgCount,'key'=>$key]) ?--> 
       <?= $this->render('slideupload', [ 'image' => $image
          
    ]) ?>	  
	</div>
</div>
