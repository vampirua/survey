<?php

/* @var $this yii\web\View */
/* @var $model \common\models\UserFormResults */

use yii\helpers\Html;

?>
<div class="item text-center">
    <div class="row">
        <?= Html::a('&times;', ['delete-answer', 'id' => $model->id], ['class' => 'close']) ?>
        <div class="col-xs-12">
            Form name : <?= $model->refForm->name ?>
        </div>
        <div class="col-xs-12">
            <?= date('Y-m-d', $model->create_at) ?>
        </div>
        <?php foreach ($model->values as $name => $answer): ?>
            <div class="col-xs-12">
                <?php
                if (is_array($answer)) {
                    $answer = implode(",", $answer);
                }
                echo $name . ':' . $answer
                ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
