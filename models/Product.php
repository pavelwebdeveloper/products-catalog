<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "announcement".
 *
 * @property int $announcementId
 * @property string $announcementTitle
 * @property string $announcementDescription
 * @property string $announcementAuthorName
 * @property string $announcementCreationDate
 * @property int $siteuserId
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[/*'id', */'imageId', 'productSKU', 'productName', 'productAmount', 'productType'], 'required'],
            //[['id'], 'integer'],
            [['imageId'], 'integer'],
            [['productSKU'], 'string'],
            [['productName'], 'string'],
            [['productAmount'], 'integer'],
            [['productType'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Product ID',
            'imageId' => 'Image ID',
            'productSKU' => 'Product SKU',
            'productName' => 'Product Name',
            'productAmount' => 'Product Amount',
            'productType' => 'Product Type',
        ];
    }
}
