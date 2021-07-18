<?php

/* @var $this yii\web\View */

/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\bootstrap\Html;
use yii\grid\GridView;
use yii\helpers\Url;


$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="body-content">

        <div class="row">
            <div class="col-xs-12">
                <div class="col-xs-12">
                    <h2>
                        Form
                    </h2>
                </div>
                <div class="col-xs-12">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'name',
                            [
                                'attribute' => 'author',
                                'value' => function (\common\models\Forms $model) {
                                    return $model->createdBy->name;
                                }
                            ],
                            [
                                'attribute' => 'created_by',
                                'format' => 'date'
                            ],
                            [
                                'attribute' => 'created_at',
                                'format' => 'date'
                            ],
                            [
                                'attribute' => 'updated_at',
                                'format' => 'date'
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{create}',
                                'buttons' => [
                                    'create' => function ($url, $model) {
                                        $url = Url::to(['form', 'id' => $model->id]);
                                        return Html::a('Create', $url, ['title' => 'Create form']);
                                    },
                                ]
                            ]
                        ],
                    ]); ?>
                </div>
            </div>
        </div>

    </div>
</div>
