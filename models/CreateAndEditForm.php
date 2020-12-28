<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Product;


/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class CreateAndEditForm extends Model
{
    public $imageId;
    public $productSKU;
    public $productName;
    public $productAmount;
    public $productType;
    //public $userId;

    public function create()
            {
     /*
     echo "OOOOOOOOOOOOOOOOOOOOOOOOOOO";
     var_dump((int)$this->imageId)."<br>";
     var_dump($this->productSKU)."<br>";
     var_dump($this->productName)."<br>";
     var_dump((int)$this->productAmount)."<br>";
     var_dump($this->productType)."<br>";
         exit;
      * *
      */
     
     $product = new Product();
     $product->imageId = (int)$this->imageId;
     $product->productSKU = $this->productSKU;
     $product->productName = $this->productName;
     $product->productAmount = (int)$this->productAmount;
     $product->productType = $this->productType;
     //$product->userId = $this->userId;
     //var_dump($product);
     //exit;
     //var_dump($product)."<br>";
        // exit;
     return $product->save();
    }
    
     /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['imageId', 'productSKU', 'productName', 'productAmount', 'productType'/*, 'userId'*/], 'required'],
        ];
    }   

    
}

