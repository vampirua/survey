<?php

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $fo */

/* @var $model \common\models\Forms */

use common\models\FormFields;
use frontend\helpers\HtmlHelpers;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = $model->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-form-create">
    <div class="row">
        <div class="col-xs-12">
            <h2>
                Fill the form : <?= $model->name ?>
            </h2>
        </div>
        <div class="col-xs-12">
            <h4>
                Author: <?= $model->createdBy->name ?>
            </h4>
        </div>
        <div class="col-xs-12">
            <div class="main">
                <?= Html::beginForm('', 'post'); ?>

                <?php /* @var $field  FormFields */ ?>
                <?php foreach ($model->formFields as $field): ?>
                    <br>
                    <?php echo HtmlHelpers::getHtmlFields($field->refFiled) ?>
                    <br>
                <?php endforeach; ?>

                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>

                <?php Html::endForm(); ?>
            </div>
        </div>
    </div>

</div>
