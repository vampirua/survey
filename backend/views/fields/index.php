<?php

use common\models\Fields;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fields';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fields-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Fields', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'display_name',
            'name',
            [
                'attribute' => 'ref_field_type',
                'value' => function (Fields $model) {
                    return Fields::getType($model->ref_field_type);
                }
            ],

            //'create_at',
            //'update_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
