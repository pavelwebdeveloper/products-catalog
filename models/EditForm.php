<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;


/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class EditForm extends Model
{
    public $imageFile;
    public $productSKU;
    public $productName;
    public $productAmount;
    public $productType;
    public $userId;

    public function create()
            {
     $product = new Product();
     $product->productImage = $this->imageFile->baseName . '.' . $this->imageFile->extension;
     $product->productSKU = $this->sku;
     $product->productName = $this->name;
     $product->productAmount = $this->amount;
     $product->productType = $this->type;
     $product->userId = $this->userId;
     return $product->save();
    }
    
     /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['image', 'sku', 'name', 'amount', 'type', 'userId'], 'required'],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    
    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('images/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
    

    
}

