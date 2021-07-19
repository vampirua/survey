<?php

use common\models\UserFormResults;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserFormResultsSerach */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Form Results';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-form-results-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            [
                'attribute' => 'ref_user',
                'value' => function (UserFormResults $model) {
                    return $model->refUser->name;
                },
            ],
            [
                'attribute' => 'ref_form',
                'value' => function (UserFormResults $model) {
                    return $model->refForm->name;
                },
            ],
            [
                'attribute' => 'values',
                'value' => function (UserFormResults $model) {
                    $i = 0;
                    $html = '';
                    foreach ($model->values as $name => $answer) {
                        $i++;
                        if ($i <= 5) {
                            if (is_array($answer)) {
                                $answer = implode(",", $answer);
                            }
                            $html .= $name . ':' . $answer . ' ' . ' ;';
                        }
                    }

                    return $html;
                },
            ],
            [
                'attribute' => 'create_at',
                'format' => 'date',
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
            ],
        ],
    ]); ?>


</div>
