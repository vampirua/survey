<?php

use unclead\multipleinput\MultipleInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Fields */
/* @var $form yii\widgets\ActiveForm */
/* @var $typeForm array */

$script = <<<JS
      
jQuery('#fields-ref_field_type').on('change', function() {
 if(this.value  == 2 || this.value  == 3 ){
     jQuery('.data-input').css('display','block');
 }else{
     jQuery('.data-input').css('display','none');
 }
});
JS;
$this->registerJs($script, yii\web\View::POS_READY);
?>

<div class="fields-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'display_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ref_field_type')->dropDownList(\common\models\Fields::getTypes()) ?>

    <div class="data-input" style="display: none">

        <?= $form->field($model, 'variant')->widget(MultipleInput::class, [
            'max' => 6,
            'min' => 1,
            'allowEmptyList' => false,
            'enableGuessTitle' => true,
            'addButtonPosition' => MultipleInput::POS_ROW, // show add button in the header
        ])->label(false) ?>

    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
