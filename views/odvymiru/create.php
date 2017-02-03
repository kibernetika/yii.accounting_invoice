<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OdVymiru */

$this->title = Yii::t('app', 'Нова одиниця виміру');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Od Vymirus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="od-vymiru-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
