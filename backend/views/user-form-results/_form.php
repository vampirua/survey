<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UserFormResults */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form-results-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ref_user')->textInput() ?>

    <?= $form->field($model, 'ref_form')->textInput() ?>

    <?= $form->field($model, 'values')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'create_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
