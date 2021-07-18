<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UserFormResults */

$this->title = 'Create User Form Results';
$this->params['breadcrumbs'][] = ['label' => 'User Form Results', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-form-results-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
