<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Forms */
/* @var $fields common\models\Fields */
/* @var $hasFields common\models\Fields */

$this->title = 'Update Forms: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="forms-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_updateForm', [
        'model' => $model,
        'fields' => $fields,
        'hasFields' => $hasFields,
    ]) ?>

</div>