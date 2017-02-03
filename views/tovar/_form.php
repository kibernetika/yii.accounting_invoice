<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Tovar */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
$this->registerJs(
    '$("document").ready(function(){
            $("#new_tovar").on("pjax:end", function() {
                $.pjax.reload({container:"#tovar"});  
        });
    });'
);
?>

<div class="tovar-form container" style="width: 500px;">
    <?php yii\widgets\Pjax::begin(['id' => 'new_tovar']) ?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nazva')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent')->textInput() ?>

    <?
    $odVymiru = \app\models\OdVymiru::find()->orderBy(['name' => SORT_ASC])->all();
    $source_items = ArrayHelper::map($odVymiru,'id','name');
    $params = ['prompt' => 'Виберіть одиниці виміру'];
    echo $form->field($model, 'od_vymiru')->dropDownList($source_items, $params);?>

<!--    --><?//= $form->field($model, 'od_vymiru')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'is_directory')->checkbox([], false) ?>
<!---->
<!--    --><?//= $form->field($model, 'deleted')->checkbox([], false) ?>

    <?= $form->field($model, 'is_directory')->checkbox(['checked' => true]) ?>

    <?= $form->field($model, 'deleted')->checkbox(['checked' => true]) ?>

    <?= $form->field($model, 'barcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cina_kup')->textInput() ?>

    <?= $form->field($model, 'cina_rozdr')->textInput() ?>

    <?= $form->field($model, 'manufacturer')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
</div>
