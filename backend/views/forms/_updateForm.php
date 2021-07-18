<?php

use kartik\sortinput\SortableInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Forms */
/* @var $fields common\models\Fields */
/* @var $hasFields common\models\Fields */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="forms-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'create_form')->widget(SortableInput::class, [
                'items' => $hasFields,
                'hideInput' => false,
                'sortableOptions' => [
                    'connected' => true,
                ],
                'options' => ['class' => 'form-control', 'readonly' => true,]
            ]); ?>
        </div>

        <div class="col-sm-6">
            <?= $form->field($model, 'fields')->widget(SortableInput::class, [
                'items' => $fields,
                'hideInput' => false,
                'sortableOptions' => [
                    'connected' => true,
                ],
                'options' => ['class' => 'form-control', 'readonly' => true,]
            ]); ?>
        </div>
        <br>
        <div class="col-xs-12">
            <?= Html::resetButton('Reset Form', ['class' => 'btn btn-secondary']) ?>
        </div>
    </div>
    <br>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
