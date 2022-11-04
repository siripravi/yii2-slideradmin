<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\products\models\Brand */

$this->title = Yii::t('app', 'Create Slider');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Slider'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
  <div class="col-6">

    <?= $this->render('_form', [
        'model' => $model,'key' =>$key, 'imgCount' => $imgCount
    ]) ?>
   </div>
</div>
