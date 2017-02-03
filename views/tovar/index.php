<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\OdVymiru;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TovarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tovars';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tovar-index">

    <h3>Товари</h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a('Створити товар', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(['id' => 'tovar']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model) {
//            if ($model->cina_rozdr == 0) {
//            return ['style' => 'background-color: #ffff88;'];
//            }
        },
        'columns' => [
            [
                'attribute'=>'id',
                'value'=>'id',
                'contentOptions'=>['style'=>'max-width: 20px;']
            ],
            [
                'attribute'=>'nazva',
                'value'=>'nazva',
                'contentOptions'=>['style'=>'min-width: 400px;']
            ],
            'parent',
            [
                'attribute' => 'ovymiru',
                'value' => 'ovymiru.name',
                'filter' => Html::activeDropDownList(
                    $searchModel, 'od_vymiru', ArrayHelper::map(
                        OdVymiru::find()->orderBy(['name' => SORT_ASC])->asArray()->all(),
                        'id',
                        'name'
                ), ['class'=>'form-control','prompt' => 'Всі', 'style'=>'min-width: 70px;']),
            ],
            'myIsDirectory',
            'myDeleted',
            'barcode',
            'cina_kup',
            'cina_rozdr',
            'manufacturer',
            ['class' => 'yii\grid\ActionColumn', 'contentOptions'=>['style'=>'min-width: 70px;']],
        ],
    ]); ?>
    <?php Pjax::end() ?>

    <style>
        .selected{
            border: 2px solid red;
        }
    </style>

    <script>
        var $currentTable;
        function rowClick(e){
            var rowIndex;
            $currentTable = $(this).closest('tbody');
            rowIndex = $('tr', $currentTable).index( $(this).closest('tr'));
            $( $currentTable).data( 'rowIndex', rowIndex);
            $('tr', $currentTable).removeClass('selected');
            $(this).addClass('selected');
            this_row = $(this);
        }

        function initTable(){
            var $rows = $( 'tr', this);
            $rows.on( 'click', rowClick);
            $(this).data("rowTotal", $rows.length);
        }
        function arrows(e){
            var rowIndex = $( $currentTable).data( 'rowIndex')
                , rowTotal = $('tbody').find('tr').length;
            if( e.keyCode == 38  &&  rowIndex > 0) {
                rowIndex--;
            } else if( e.keyCode == 40  &&  rowIndex < (rowTotal-1)) {
                rowIndex++;
            } else if( e.keyCode == 13 ) {
                var link = $(this_row).find('[title="Update"]').first();
                window.location.href=link.attr('href');
            } else return;
            $( $currentTable).data( 'rowIndex', rowIndex);
            $('tr', $currentTable).removeClass('selected');
            $('tr', $currentTable).eq( rowIndex).addClass('selected');
        }

        var this_row;
        $('table').each(initTable);
        $(window).keydown(arrows);

    </script>
</div>
