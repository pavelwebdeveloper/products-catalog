<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;



?>
<div class="site-login">
 
 <?php if(Yii::$app->user->isGuest) {
  $this->goHome();
 
} else {?>
 
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Now you can update the product:</p>
    
    <h1><?php //echo $message; ?></h1>

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'uploadFile[]')->fileInput(['multiple'=>'multiple']) ?>

        <?= $form->field($model, 'sku')->textInput(['value'=> $product->productSKU, 'autofocus' => true]) ?>
    
    <?= $form->field($model, 'name')->textInput(['value'=> $product->productName, 'autofocus' => true]) ?>
    
    <?= $form->field($model, 'amount')->textInput(['value'=> $product->productAmount, 'autofocus' => true, 'type' => 'number']) ?>
    
        <?= $form->field($model, 'type')->textInput(['value'=> $product->productType, 'autofocus' => true]) ?>
    
        <?= $form->field($model, 'siteuserId')->hiddenInput(['value'=> (int)$userId[0]["siteuserId"]])->label(false);?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Save', ['update', 'announcementId'=>$announcement->announcementId, 'class' => 'btn btn-primary']); ?>
            </div>
        </div>
    
    <?php ActiveForm::end(); ?>
    
<?php } ?>
   


