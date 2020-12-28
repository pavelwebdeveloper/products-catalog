<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

$this->title = 'My Yii Application';
?>

<?php //var_dump($images)."<br>"; ?>
<?php //var_dump($products); ?>
<?php //exit;?>

<div class="site-index">

    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>

    <div class="body-content">
     
     <?php if(isset(Yii::$app->user->identity->username)) { ?>
     
     <?php if(Yii::$app->user->identity->username == 'admin') { ?>
     
     <?= Html::a('Add Product', ['update_products', 'productId'=>0])."<br>"; ?> 
     <?= Html::a('Upload an image', ['upload']); ?>
     <?php } else { ?>
     
     <?php echo ""; } ?>
     
     <?php } else { ?>
     
     <?php echo ""; } ?>

        <h1>Products</h1>
<table class="table table-hover">
  <tr>
    <th>Изображение</th>
    <th>SKU</th>
    <th>Название</th>
    <th>Кол-во на складе</th>
    <th>Тип товара</th>
    <th></th>
    <th></th>
  </tr>
  
<?php foreach ($products as $product): ?>
  <?php 
  /* This code is for test purposes
  var_dump($announcement->siteuserId);
   */
  ?>
   
    <tr>
     <td><?php foreach ($images as $image): ?>
     <?php if($product->imageId == $image->id){ ?>
     <?= Html::img($image->imagePath); ?>
     <?php }; ?>
     <?php endforeach; ?></td>
     <td><?= $product->productSKU ?></td>
     <td><?= $product->productName ?></td>
     <td><?= $product->productAmount ?></td>  
     <td><?= $product->productType ?></td> 
     <?php if(Yii::$app->user->isGuest) { echo "";} else {?>
     <td><?= Html::a('Edit', ['update_products', 'productId'=>$product->id], ['class'=>'label label-primary']) ?></td>  
     <?php } ?>
  </tr>
<?php endforeach; ?>
</table>

<?= LinkPager::widget(['pagination' => $pagination]) ?>

    </div>
</div>
