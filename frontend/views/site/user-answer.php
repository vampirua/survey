<?php

/* @var $this yii\web\View */

/* @var $dataProvider \common\models\UserFormResults */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\ListView;

$this->title = 'Result';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-forms">

    <div class="row">
        <div class="col-xs-12">
            <?php
            echo ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_item',
                'options' => [
                    'class' => 'col-xs-3'
                ],
            ]);
            ?>
        </div>
    </div>
</div>
