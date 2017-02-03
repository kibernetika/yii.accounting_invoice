<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TovarSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tovar-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nazva') ?>

    <?= $form->field($model, 'parent') ?>

    <?= $form->field($model, 'od_vymiru') ?>

    <?= $form->field($model, 'is_directory') ?>

    <?php  echo $form->field($model, 'deleted') ?>

    <?php  echo $form->field($model, 'barcode') ?>

    <?php  echo $form->field($model, 'cina_kup') ?>

    <?php  echo $form->field($model, 'cina_rozdr') ?>

    <?php  echo $form->field($model, 'manufacturer') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
