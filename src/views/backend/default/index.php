<?php

//use dench\sortable\grid\SortableColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Slider');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">

 <div class="card card-primary card-outline product-update">
<div class="card-header ">
<p class="card-title ml-auto p-2 pull-right">
        <?= Html::a(Yii::t('app', 'Create {0}', Yii::t('app', 'Slider')), ['create'], ['class' => 'btn btn-success']) ?>
</p>
</div>
<div class="card-body">
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'rowOptions' => function ($model, $key, $index, $grid) {
            return [
             //   'data-position' => $model->position,
            ];
        },
        'columns' => [
           /* [
                'class' => SortableColumn::class,
            ],*/
            'title',
            'image_count',            
            'enabled',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
            ],
		    [
			    'class' => 'yii\grid\ActionColumn',
				'template' => '{info}',
				'buttons' => [
					'info' => function ($url, $model) {
						return Html::a('Slides', $url, [
									'title' => Yii::t('app', 'Info'),
						]);
					}
				],
				'urlCreator' => function ($action, $model, $key, $index) {
					if ($action === 'info') {
						$url = Url::to('/admin/slider/slider-image/index?id='.$model->id);
						return $url;
					}
				}

			]
	
        ],
        'options' => [
           /* 'data' => [
                'sortable' => 1,
                'sortable-url' => Url::to(['sorting']),
            ]  */
        ],
    ]); ?>
	</div>
</div>

</div>
