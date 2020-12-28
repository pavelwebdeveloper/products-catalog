<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\Product;
use app\models\Image;



?>
<div class="site-login">
 
 <?php if(Yii::$app->user->isGuest) {
  $this->goHome();
 
} else {?>
 
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Now you can update the product:</p>
    
    <h1><?php //echo $message; ?></h1>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'imageId')->dropdownList(
    Image::find()->select(['imagePath', 'id'])->indexBy('id')->column(),
    ['prompt'=>'Select Image']) ?>

        <?= $form->field($model, 'productSKU')->textInput(['value'=> $product->productSKU ?? '', 'autofocus' => true]) ?>
    
    <?= $form->field($model, 'productName')->textInput(['value'=> $product->productName ?? '', 'autofocus' => true]) ?>
    
    <?= $form->field($model, 'productAmount')->textInput(['value'=> $product->productAmount ?? '', 'autofocus' => true, 'type' => 'number']) ?>
    
        <?= $form->field($model, 'productType')->textInput(['value'=> $product->productType ?? '', 'autofocus' => true]) ?>
    
        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Save', ['update_products', 'productId'=>$product->id ?? 0, 'class' => 'btn btn-primary']); ?>
            </div>
        </div>
    
    <?php ActiveForm::end(); ?>
    
<?php } ?>
   


