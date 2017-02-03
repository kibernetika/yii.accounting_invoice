<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OdVymiruSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Od Vymirus');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="od-vymiru-index">

    <h3>Одиниці виміру</h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<!---->
<!--    <p>-->
<!--        --><?//= Html::button('Створити', ['value'=>\yii\helpers\Url::to('index.php?r=odvymiru/create ') ,'class' => 'btn btn-success', 'id'=>'modalButton']) ?>
<!--    </p>-->
    <?php
        Modal::begin([
        'id' => 'comm',
        'header' => 'Нова одиниця виміру',
        'toggleButton' => [
            'class' => 'btn btn-success',
            'label' => 'Створити',
            'tag' => 'a',
            'data-target' => '#comm',
            'href' => \yii\helpers\Url::to(['/odvymiru/create']),
        ],
        'clientOptions' => false,
        ]);
        Modal::end();
    ?>
    <?php
    yii\bootstrap\Modal::begin([
    'id'=>'editModalId',
    'class' =>'modal',
    'size' => 'modal-md',
    ]);
    echo "<div class='modalContent'></div>";
    yii\bootstrap\Modal::end();

    $this->registerJs(
    "$(document).on('ready pjax:success', function() {
    $('.modalButton').click(function(e){
    e.preventDefault(); //for prevent default behavior of <a> tag.
        var tagname = $(this)[0].tagName;
        $('#editModalId').modal('show').find('.modalContent').load($(this).attr('href'));
        });
        });
        ");

        // JS: Update response handling
    $this->registerJs(
        'jQuery(document).ready(function($){
    $(document).ready(function () {
        $("body").on("beforeSubmit", "form#lesson-learned-form-id", function () {
            var form = $(this);
            // return false if form still have some validation errors
            if (form.find(".has-error").length) {
                return false;
            }
            // submit form
            $.ajax({
                url    : form.attr("action"),
                type   : "post",
                data   : form.serialize(),
                success: function (response) {
                    $("#editModalId").modal("toggle");
                    $.pjax.reload({container:"#lessons-grid-container-id"}); //for pjax update
                },
                error  : function () {
                    console.log("internal server error");
                }
            });
            return false;
        });
    });
});'
    );
    ?>
    <?php Pjax::begin(['id' => 'lessons-grid-container-id']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
//            [
//                'class' => 'yii\grid\ActionColumn',
////                'buttons' => [
////                    'update' => function ($url, $model, $key) {
////
////                    },
////                ]
//            ],
            ['class' => 'yii\grid\ActionColumn', 'template'=>'{custom_view}',
                'template' => '{custom_view} {view} {update} {delete}',
                'buttons' =>[
                        'custom_view' => function ($url, $model) {
                        // Html::a args: title, href, tag properties.
                        return Html::a( '<i class="glyphicon glyphicon-new-window"></i>',
                            ['odvymiru/update', 'id'=>$model['id']],
                            ['class'=>'btn btn-xs btn-default modalButton', 'title'=>'Редагувати одницю виміру', ]
                        );
                    },
                    ]
            ],
        ],
    ]); ?>
    <?php Pjax::end() ?>
</div>
