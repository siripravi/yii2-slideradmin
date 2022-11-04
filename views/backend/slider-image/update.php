<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model dench\app\models\app */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'app',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'apps'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="app-update">

    <?= $this->render('_form', [
        'model' => $model, 'src' => $src
    ]) ?>

</div>
