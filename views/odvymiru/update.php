<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OdVymiru */

$this->title = Yii::t('app', 'Редагування {modelClass}', [
    'modelClass' => 'Одиниці виміру',
]) ;
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Od Vymirus'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
//?>
<div class="od-vymiru-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
